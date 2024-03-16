<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('invoice');
    }

    /**
     * @param string $code
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(string $code)
    {
        $invoice = Invoice::getByCode($code);

        if ($invoice->order->user_id != Auth::id()) {
            abort(404);
        }
    
        return view('invoice-view', [
            'invoice' => Invoice::getByCode($code)
        ]);
    }
}
