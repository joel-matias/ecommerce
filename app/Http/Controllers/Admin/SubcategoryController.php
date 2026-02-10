<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::orderBy('id', 'desc')
            ->with('category.family')
            ->paginate(10);

        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        SubCategory::create($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Subcategoria creada!',
            'text' => 'La subcategoria ha sido creada correctamente.',
        ]);

        return redirect()->route('admin.subcategories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subcategory)
    {

        return view('admin.subcategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subcategory)
    {
        if ($subcategory->products->count() > 0) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'No se puede eliminar la subcategoria!',
                'text' => 'La subcategoria tiene productos asociados.',
            ]);

            return redirect()->route('admin.subcategories.index');
        }

        $subcategory->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Subcategoria eliminada!',
            'text' => 'La subcategoria ha sido eliminada correctamente.',
        ]);

        return redirect()->route('admin.subcategories.index');
    }
}
