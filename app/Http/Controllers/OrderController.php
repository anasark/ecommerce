<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('order');
    }

    public function view(Order $order)
    {
        return view('order-view', compact('order'));
    }
}
