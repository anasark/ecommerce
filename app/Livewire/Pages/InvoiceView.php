<?php

namespace App\Livewire\Pages;

use App\Models\Invoice;
use App\Models\Order;
use Livewire\Component;

class InvoiceView extends Component
{
    public $invoice;
    public $orderItems;

    public function mount(Invoice $invoice)
    {
        $orders = Order::findOrFail($invoice->id);

        $this->invoice    = $invoice;
        $this->orderItems = $orders->orderItems;
    }

    public function render()
    {
        return view('livewire.pages.invoice-view');
    }
}
