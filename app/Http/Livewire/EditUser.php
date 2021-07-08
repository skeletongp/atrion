<?php

namespace App\Http\Livewire;

use App\Models\Place;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;
class EditUser extends Component
{
    public $user, $roles;
    public $name, $email, $password, $password_confirm, $role, $place_id;
    public function render()
    {
        $this->name=$this->user->name;
        $this->email=$this->user->email;
        $this->role=$this->user->getRoleNames()[0];
        $this->roles=Role::all();
        $places=Place::all();
        return view('livewire.edit-user', compact('places'));
    }
    protected $rules=[
        "name"=>"required",
        "email"=>"required",
        "place_id"=>"required",
        "password_confirm"=>"same:password",

    ];
    public function update()
    {
        $this->validate();

        $user=$this->user;
        $user->name=$this->name;
        $user->email=$this->email;
        $user->place_id=$this->place_id;

        if(!empty($this->password)){
            $user->password=Hash::make($this->password);
        }

        $user->save();
        if(!empty($this->role)){
            dd($this->role);
            $user->syncRoles([$this->role]);
        }
        session()->flash('success', 'Datos actualizados');
        $this->reset('name','role','email','place_id');
        return redirect()->route('users.show', $user);
    }
}
