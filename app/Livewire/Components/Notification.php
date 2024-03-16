<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Notification extends Component
{
    public $notification = false;
    public $isSuccess    = true;

    public function render()
    {
        return view('livewire.components.notification');
    }

    #[On('show-notification')]
    public function showNotification($message, $isSuccess = true, $manualCloseReload = false)
    {
        if ($this->notification) {
            $this->closeNotification();
        }
    
        $this->notification = $message;
        $this->isSuccess    = $isSuccess;

        if (! $manualCloseReload) {
            $this->dispatch('auto-close-notification');
        }
    }

    #[On('close-notification')]
    public function closeNotification()
    {
        $this->notification = false;


        $this->dispatch('notification-closed');
    }
}
