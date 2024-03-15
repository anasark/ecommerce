<?php

namespace App\Http\Controllers;

use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('cart', [
            'cart' => Cart::getCartSession()
        ]);
    }
}
