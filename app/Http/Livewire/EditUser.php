<?php

namespace App\Http\Livewire;

use App\Models\Place;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class EditUser extends Component
{
    public $user, $roles;
    public $name, $email, $password, $password_confirm, $role, $place_id, $permissions = [];
    protected $listeners = ['multi' => 'multi'];
    public function render()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role = $this->user->getRoleNames()[0];
        $this->place_id = $this->user->place_id;
        $this->roles = Role::all();
        $places = Place::all();
        return view('livewire.edit-user', compact('places'));
    }
    protected $rules = [
        "name" => "required|max:30",
        "email" => "required",
        "place_id" => "required",
        "password_confirm" => "same:password",

    ];
    public function update()
    {
        $this->validate();
        $user = $this->user;

        if (Auth::user()->can('Gestionar Usuarios') || $user->id==Auth::user()->id) {
            $user->name = $this->name;
            $user->slug=Str::slug($this->name);
            $user->email = $this->email;
            $user->edited_by =Auth::user()->id;
            $user->place_id = $this->place_id;

            if (!empty($this->password)) {
                $user->password = Hash::make($this->password);
            }

            if (!empty($this->permissions) && $user->id != 1) {

                foreach ($user->getAllPermissions() as $permi) {
                    array_push($this->permissions, $permi->name);
                }
                $user->syncPermissions($this->permissions);
            }

            $user->save();
            if (!empty($this->role) && $user->id != 1) {
                $user->syncRoles([$this->role]);
            }
            session()->flash('success', 'Datos actualizados');
            $this->reset('name', 'role', 'email', 'place_id');
            Alert::info('Datos Actualizados', 'Se han actualizado los datos del usuario', 'success');
           return redirect()->route('users_show',$user);

        }
    }
    public function multi($value)
    {
        $this->permissions = $value;
    }
}