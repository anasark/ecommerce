<?php

namespace App\Livewire\Components;

use Livewire\Component;

class QuantityButton extends Component
{
    public $quantity;
    public $id;

    public function mount($quantity, $id = null)
    {
        $this->quantity = $quantity;
        $this->id       = $id;
    }

    public function render()
    {
        return view('livewire.components.quantity-button');
    }

    public function change()
    {
        $this->dispatch('change-quantity', quantity: $this->quantity, id: $this->id);
    }

    public function increment()
    {
        $this->dispatch('increment', id: $this->id);
    }

    public function decrement()
    {
        $this->dispatch('decrement', id: $this->id); 
    }
}
