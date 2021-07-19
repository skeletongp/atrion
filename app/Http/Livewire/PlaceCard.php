<?php

namespace App\Http\Livewire;

use App\Models\Place;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PlaceCard extends Component
{
    use WithPagination;
    public $search = "", $is_active = 1, $icon = "fas fa-trash text-red-500", $button = "fas fa-recycle", $title = "Sucursales activas", $confirm = "¿Eliminar sucursal?";
    public $name, $phone, $location, $message;
    protected $listeners = ['place_updated' => 'update_message', 'message' => 'add_message'];
    public function render()
    {
       if ($this->is_active==1) {
        $places = Place::
        where('name', 'like', '%' . $this->search . '%')
        ->paginate(3);
       } else {
        $places = Place::
        onlyTrashed()
        ->where('name', 'like', '%' . $this->search . '%')
        ->paginate(3);
       }
       
        return view('livewire.place-card', compact('places'));
    }
    public function update_message()
    {
        $this->message = 'Sucursal Actualizada';
        $this->render();
    }
    public function add_message()
    {
        $this->message = 'Sucursal Registrada';
        $this->render();
    }
    public function softdelete($place)
    {
        $place=Place::withTrashed()->where('slug','=',$place)->first();
        if (Auth::user()->can('Gestionar Sucursales')) {
            if ($place->deleted_at==null) {
               $place->delete();
            } else {
                $place->restore();
            }
            
            $this->render();
        }
    }
    public function toggle()
    {
        if ($this->is_active == 1) {
            $this->is_active = 0;
            $this->title = 'Sucursales eliminadas';
            $this->icon = 'fas fa-sync-alt text-blue-500';
            $this->confirm = '¿Restaurar sucursal?';
            $this->button = 'fa-reply-all';
            $this->resetPage();
        } else {
            $this->reset('is_active','title','confirm','icon','button');
            $this->resetPage();
        }
    }
}
