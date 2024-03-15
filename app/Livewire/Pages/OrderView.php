<?php

namespace App\Livewire\Pages;

use App\Models\Order;
use Livewire\Component;

class OrderView extends Component
{
    public $order;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.pages.order-view');
    }
}
