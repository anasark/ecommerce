<?php

namespace App\Http\Controllers;

use App\Models\Cart;

class CartController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('cart', [
            'cart' => Cart::getCartSession()
        ]);
    }
}
