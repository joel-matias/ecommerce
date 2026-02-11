<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\SubCategory;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $families;

    public $family_id = '';

    public $category_id = '';

    public $image;

    public $product = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'image_path' => '',
        'price' => '',
        'sub_category_id' => '',
    ];

    public function mount()
    {
        $this->families = Family::all();
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => 'Error',
                    'text' => 'Por favor, corrige los errores en el formulario',
                ]);
            }
        });
    }

    public function updatedFamilyId()
    {
        $this->category_id = '';
        $this->product['sub_category_id'] = '';
    }

    public function updatedCategoryId()
    {
        $this->product['sub_category_id'] = '';
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->family_id)->get();
    }

    #[Computed()]
    public function subcategories()
    {
        return SubCategory::where('category_id', $this->category_id)->get();
    }

    public function store()
    {
        $this->validate([
            'image' => 'required|image|max:2048',
            'product.sku' => 'required|unique:products,sku',
            'product.name' => 'required|max:255',
            'product.description' => 'nullable',
            'product.price' => 'required|numeric|min:0',
            'product.sub_category_id' => 'required|exists:sub_categories,id',
        ]);

        $this->product['image_path'] = $this->image->store('products', 'public');

        $product = Product::create($this->product);

        session()->flash('swal',
            [
                'icon' => 'success',
                'title' => 'Producto creado',
                'text' => 'El producto se ha creado correctamente',
            ]
        );

        return redirect()->route('admin.products.edit', $product);
    }

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
