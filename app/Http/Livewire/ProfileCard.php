<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Contracts\Role;

class ProfileCard extends Component
{
    use WithPagination;
    public $user;
    public $name, $email, $role, $place, $sales;
    public function render()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->place = $this->user->place->name;
        $this->sales = $this->user->sales->count();
        $this->role = $this->user->getRoleNames()[0];

        $permissions = User::find(1)->getAllPermissions();
        return view('livewire.profile-card', compact('permissions'));
    }
    public function revoke($permission)
    {
        if (Auth::user()->can('Gestionar Usuarios')) {
            $this->user->revokePermissionTo($permission);
            $this->render();
        }
    }
    public function assign($permission)
    {
        if (Auth::user()->can('Gestionar Usuarios')) {
            $this->user->givePermissionTo($permission);
            $this->render();
        }
    }
}
