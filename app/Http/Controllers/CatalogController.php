<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CatalogController extends Controller
{
    public function index()
    {
        return view('catalog', [
            'products' => Product::getProducts()
        ]);
    }

    public function view(Product $product)
    {
        return view('catalog-view', compact('product'));
    }
}
