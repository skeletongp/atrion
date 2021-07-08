<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class ProfileCard extends Component
{
    use WithPagination;
    public $user;
    public $name, $email, $role, $place;
    public function render()
    {
        $this->name=$this->user->name;
        $this->email=$this->user->email;
        $this->place=$this->user->place->name;
        $this->role=$this->user->getRoleNames()[0];
        return view('livewire.profile-card');
    }
}
