<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;
class EditUser extends Component
{
    public $user, $open=true, $roles;
    public $name, $email, $password, $password_confirm, $role;
    public function render()
    {
        $this->name=$this->user->name;
        $this->email=$this->user->email;
        $this->role=$this->user->getRoleNames()[0];
        $this->roles=Role::all();
        return view('livewire.edit-user');
    }
    protected $rules=[
        "name"=>"required",
        "email"=>"required",
        "password_confirm"=>"same:password",

    ];
    public function update()
    {
        $this->validate();
        $user=$this->user;
        $user->name=$this->name;
        $user->email=$this->email;
        if(!empty($this->password)){
            $user->password=Hash::make($this->password);
        }
        $user->save();
        $user->syncRoles([$this->role]);
        session()->flash('success', 'Datos actualizados');
        return redirect()->route('users.show', $user);
    }
}
