<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage categories');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }
}