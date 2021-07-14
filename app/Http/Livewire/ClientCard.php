<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ClientCard extends Component
{
    public $client;
    public function render()
    {
        return view('livewire.client-card');
    }
}
