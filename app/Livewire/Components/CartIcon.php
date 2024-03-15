<?php

namespace App\Livewire\Components;

use App\Models\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{
    public $count;

    public function mount()
    {
        $this->getCart();
    }

    public function render()
    {
        return view('livewire.components.cart-icon');
    }

    #[On('refresh-cart')]
    public function refreshComponent()
    {
        $this->getCart();
    }

    private function getCart()
    {
        $cart = Cart::getCartSession();

        $this->count = $cart->cartItems->count();
    }
}
