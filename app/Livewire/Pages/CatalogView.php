<?php

namespace App\Livewire\Pages;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class CatalogView extends Component
{
    public $quantity;
    public $product;

    public function mount(Product $product)
    {
        $this->quantity = 1;
        $this->product  = $product;
    }

    public function render()
    {
        return view('livewire.pages.catalog-view');
    }

    #[On('change-quantity')]
    public function changeQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    #[On('increment')]
    public function increment()
    {
        $this->quantity++;
    }

    #[On('decrement')]
    public function decrement()
    {
        if ($this->quantity <= 1) {
            return;
        }

        $this->quantity--;
    }

    public function addToCart()
    {
        $cart = Cart::getCartSession();

        CartItem::insertItem($cart->id, $this->product->id, $this->quantity);

        $this->dispatch('refresh-cart');
        $this->dispatch('show-notification', message: 'Item added to cart.');
    }
}
