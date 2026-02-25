<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function show(SubCategory $subcategory)
    {
        return view('subcategories.show', compact('subcategory'));
    }
}
