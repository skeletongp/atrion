<?php

namespace App\Http\Livewire;

use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Livewire\Component;

class AddUser extends Component
{

    public $roles, $name, $email, $role, $place_id, $permissions = [];
    protected $listeners = ['multi' => 'multi'];
    protected $rules = [
        "name" => "required",
        "email" => "required|unique:users,email|email|string",
        "place_id" => "required",

    ];
    public function render()
    {
        $this->roles = Role::all();
        $places = Place::all();
        return view('livewire.add-user', compact('places'));
    }
    public function store()
    {
        if (Auth::user()->can('Gestionar Usuarios')) {
            $this->validate();
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->place_id = $this->place_id;
            $user->slug = Str::slug($this->name);
            $user->password = Hash::make("user1234");
           
            if ( $user->save()) {
                $user->syncRoles($this->role);
            $user->syncPermissions($this->permissions);
            session()->flash('added', 'Usuario añadido');
            $this->reset('name', 'email', 'place_id', 'role', 'permissions');
            alert('Usuario registrado','El usuario se ha registrado con éxito', 'success');
            $this->emit('update_user_table');
            } else {
                alert('Ha ocurrido un error','Revise e intente nuevamente', 'error');
            }
            
        }
    }
    public function multi($value)
    {
        $this->permissions = $value;
    }
}
