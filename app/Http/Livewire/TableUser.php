<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TableUser extends Component
{
    use WithPagination;
    
    protected $listeners=['render'=>'render'];
    public $search="";
    public $is_active=1, $title='Usuarios activos', $icon="fa-trash text-red-500", $confirm='¿Eliminar usuario?', $button='fa-recycle';
    public function render()
    {

        $users=User::where('is_active','=',$this->is_active)
        ->where('name','like','%'.$this->search.'%')
        ->where('email','like','%'.$this->search.'%')
        ->paginate(5);
        return view('livewire.table-user', compact('users'));
    }
    public function softdelete(User $user)
    {
        $user->is_active==1? $user->is_active=0: $user->is_active=1;;
        $user->save();
        $this->emit('render');
    }
    public function toggle()
    {
        if ($this->is_active==1) {
            $this->is_active=0;
            $this->title='Usuarios eliminados';
            $this->icon='fa-sync-alt text-blue-500';
            $this->confirm='¿Restaurar usuario?';
            $this->button='fa-reply-all';
        }
        else{
            $this->reset('is_active','title','icon','confirm', 'button');
           
        }
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
}
