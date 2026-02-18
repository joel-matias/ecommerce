<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;

    public $product;

    public $productEdit;

    public $families;

    public $family_id = '';

    public $category_id = '';

    public $image;

    public function mount($product)
    {
        $this->productEdit = $product->only(
            'sku',
            'name',
            'description',
            'price',
            'stock',
            'image_path',
            'sub_category_id'
        );

        $this->families = Family::all();

        $this->category_id = $product->subCategory->category->id;
        $this->family_id = $product->subCategory->category->family_id;
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
        $this->productEdit['sub_category_id'] = '';
    }

    public function updatedCategoryId()
    {
        $this->productEdit['sub_category_id'] = '';
    }

    #[On('variant-generate')]
    public function updateProduct()
    {
        $this->product = $this->product->fresh();
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
            'image' => 'nullable|image|max:2048',
            'product.sku' => 'required|unique:products,sku,'.$this->product->id,
            'product.name' => 'required|max:255',
            'product.description' => 'nullable',
            'product.price' => 'required|numeric|min:0',
            'product.stock' => 'required|numeric|min:0',
            'product.sub_category_id' => 'required|exists:sub_categories,id',
        ]);

        if ($this->image) {
            FacadesStorage::delete($this->productEdit['image_path']);
            $this->productEdit['image_path'] = $this->image->store('products');
        }
        $this->product->update($this->productEdit);

        session()->flash('swal',
            [
                'icon' => 'success',
                'title' => 'Producto actualizado',
                'text' => 'El producto se ha actualizado correctamente',
            ]
        );

        return redirect()->route('admin.products.edit', $this->product);
    }

    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }
}
