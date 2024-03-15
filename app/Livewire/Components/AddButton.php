<?php

namespace App\Livewire\Components;

use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;

class AddButton extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('livewire.components.add-button');
    }

    public function addItem()
    {
        $cart = Cart::getCartSession();

        CartItem::insertItem($cart->id, $this->id, 1);

        $this->dispatch('refresh-cart');
        $this->dispatch('show-notification', message: 'Item added to cart.');
    }
}
