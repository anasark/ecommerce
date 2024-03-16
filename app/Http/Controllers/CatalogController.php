<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CatalogController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('catalog', [
            'products' => Product::getProducts()
        ]);
    }

    /**
     * @param Product $product
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(Product $product)
    {
        return view('catalog-view', compact('product'));
    }
}
