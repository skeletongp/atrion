<?php

namespace App\Http\Livewire;

use App\Models\Place;
use Livewire\Component;
use Livewire\WithPagination;

class PlaceTable extends Component
{
    use WithPagination;
    public $search = "", $direction = 'asc', $order = "name", $icon_order = 'fa-sort-up';
    public $is_active = 1, $title = 'Usuarios activos', $icon = "fa-trash text-red-500", $confirm = '¿Eliminar usuario?', $button = 'fa-recycle';
    protected $listeners = ['update_place_table' => 'render'];
    public function render()
    {
        if ($this->is_active == 1) {
            $places = Place::search($this->search)
                ->orderBy($this->order, $this->direction)->paginate(10);
        } else {
            $places = Place::onlyTrashed()->search($this->search)
                ->orderBy($this->order, $this->direction)->paginate(10);
        }
        return view('livewire.place-table')->with(['places'=>$places]);
    }
    public function toggle()
    {
        if ($this->is_active == 1) {
            $this->is_active = 0;
            $this->title = 'Usuarios eliminados';
            $this->icon = 'fa-sync-alt text-blue-500';
            $this->confirm = '¿Restaurar producto?';
            $this->button = 'fa-reply-all';
        } else {
            $this->reset('is_active', 'title', 'icon', 'confirm', 'button');
        }
        $this->resetPage();
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function softdelete($place)
    {
        $place=Place::withTrashed()->where('slug','=',$place)->first();
        if($place->deleted_at==null){
            $place->delete();
        } else{
            $place->restore();
        }
        $this->render();
    }
    public function search()
    {
        $this->render();
    }
    public function order($order)
    {
        $this->order = $order;
        if ($this->direction == 'asc') {
            $this->direction = "desc";
            $this->icon_order='fa-sort-down';
        } else {
            $this->direction = "asc";
            $this->icon_order='fa-sort-up';

        }
        $this->resetPage();
    }
}
