<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage products');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}