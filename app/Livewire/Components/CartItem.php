<?php

namespace App\Livewire\Components;

use App\Models\CartItem as ModelsCartItem;
use Livewire\Attributes\On;
use Livewire\Component;

class CartItem extends Component
{
    public $cartItem;
    public $product;
    public $quantity;

    public function mount(ModelsCartItem $cartItem)
    {
        $this->cartItem = $cartItem;
        $this->product  = $cartItem->product;
        $this->quantity = $cartItem->quantity;
    }

    #[On('change-quantity')]
    public function changeQuantity($quantity, $id)
    {
        if ($this->cartItem->id != $id) {
            return;
        }

        $this->quantity = $quantity;
        $this->cartItem->quantity = $quantity;
        $this->cartItem->save();

        $this->dispatch('refresh-component'); 
    }

    #[On('increment')]
    public function increment($id)
    {
        if ($this->cartItem->id != $id) {
            return;
        }

        $this->quantity++;
        $this->cartItem->quantity++;
        $this->cartItem->save();

        $this->dispatch('refresh-component');
    }

    #[On('decrement')]
    public function decrement($id)
    {
        if ($this->cartItem->id != $id || $this->quantity <= 1) {
            return;
        }

        $this->quantity--;
        $this->cartItem->quantity--;
        $this->cartItem->save();

        $this->dispatch('refresh-component'); 
    }

    #[On('delete-item')]
    public function delete($id)
    {
        if ($this->cartItem->id != $id) {
            return;
        }

        $this->cartItem->delete();

        $this->dispatch('refresh-component'); 
        $this->dispatch('refresh-cart');
        $this->dispatch('show-notification', message: 'Item deleted from cart.');
    }

    public function render()
    {
        return view('livewire.components.cart-item');
    }
}
