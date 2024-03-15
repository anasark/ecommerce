<?php

namespace App\Livewire\Components;

use Livewire\Component;

class DeleteButton extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('livewire.components.delete-button');
    }

    public function deleteItem()
    {
        $this->dispatch('delete-item', id: $this->id);
    }
}
