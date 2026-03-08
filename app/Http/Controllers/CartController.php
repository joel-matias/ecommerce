<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifyStock;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware(VerifyStock::class);
    }

    public function index()
    {
        return view('cart.index');
    }
}