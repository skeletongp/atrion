<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProfileCard extends Component
{
    public $user;
    public $name, $email, $role;
    public function render()
    {
        $this->name=$this->user->name;
        $this->email=$this->user->email;
        $this->role=$this->user->getRoleNames()[0];
        return view('livewire.profile-card');
    }
}
