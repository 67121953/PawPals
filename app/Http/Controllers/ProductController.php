<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $sumPrice = Product::sum('price');

        return view('product.index', compact('products', 'sumPrice'));
    }
}