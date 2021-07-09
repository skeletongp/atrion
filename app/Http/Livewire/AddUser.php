<?php

namespace App\Http\Livewire;

use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

use Livewire\Component;

class AddUser extends Component
{
    
    public $roles, $name, $email, $role, $place_id, $permissions=[];
    protected $listeners=['multi'=>'multi'];
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
        $user->syncPermissions($this->permissions);
        session()->flash('added', 'Usuario añadido');
        $this->reset('name','email','place_id','role', 'permissions');
        return redirect()->route('users.show', $user);
    }
    public function multi($value)
    {
        $this->permissions=$value;
    }
}
