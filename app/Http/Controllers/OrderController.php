<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('order');
    }

    /**
     * @param Order $order
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(404);
        }

        return view('order-view', compact('order'));
    }
}
