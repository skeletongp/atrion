<?php

namespace App\Http\Livewire;

use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

use Livewire\Component;

class AddUser extends Component
{
    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public $roles, $name, $email, $role, $place_id;
    protected $rules=[
        "name"=>"required",
        "email"=>"required|unique:users,email|email|string",
        "place_id"=>"required",

    ];
    public function render()
    {
        $this->roles=Role::all();
        $places=Place::all();
        return view('livewire.add-user', compact('places'));
    }
    public function store()
    {
        $this->validate();
        $user= new User();
        $user->name=$this->name;
        $user->email=$this->email;
        $user->place_id=$this->place_id;
        $user->slug=Str::slug($this->name);
        $user->password=Hash::make("user1234");
        $user->save();
        $user->syncRoles($this->role);
        session()->flash('added', 'Usuario añadido');
        $this->reset('name','email','place_id','role');
        return redirect()->route('users.show', $user);
    }
}
