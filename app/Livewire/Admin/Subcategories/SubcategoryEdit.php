<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryEdit extends Component
{
    public $subcategory;

    public $families;

    public $subcategoryEdit = [
        'name' => '',
        'category_id' => '',
        'family_id' => '',
    ];

    public function mount($subcategory)
    {
        $this->families = Family::all();

        $this->subcategoryEdit['name'] = $subcategory->name;
        $this->subcategoryEdit['category_id'] = $subcategory->category_id;
        $this->subcategoryEdit['family_id'] = $subcategory->category->family_id;
    }

    public function updatedSubcategoryFamilyId()
    {
        $this->subcategoryEdit['category_id'] = '';
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->subcategoryEdit['family_id'])->get();
    }

    public function save()
    {
        $this->validate([
            'subcategoryEdit.name' => 'required',
            'subcategoryEdit.category_id' => 'required:exists:categories,id',
            'subcategoryEdit.family_id' => 'required:exists:families,id',
        ], [], [
            'subcategoryEdit.name' => 'nombre',
            'subcategoryEdit.category_id' => 'categoría',
            'subcategoryEdit.family_id' => 'familia',
        ]);

        $this->subcategory->update($this->subcategoryEdit);
        // session()->flash('swal', [
        //     'icon' => 'success',
        //     'title' => 'Subcategoria actualizada!',
        //     'text' => 'La subcategoria ha sido actualizada correctamente.',
        // ]);
        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Subcategoria actualizada!',
            'text' => 'La subcategoria ha sido actualizada correctamente.',
        ]);

    }

    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-edit');
    }
}
