<?php

namespace App\Http\Controllers;

use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoice');
    }

    public function view(string $code)
    {
        return view('invoice-view', [
            'invoice' => Invoice::getByCode($code)
        ]);
    }
}
