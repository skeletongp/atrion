<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientTable extends Component
{
    use WithPagination;
    
    public $search = "", $direction = 'asc', $order = "name", $icon_order = 'fa-sort-up', $place_id;
    public $is_active = 1, $title = 'Productos activos', $icon = "fa-trash text-red-500", $confirm = '¿Eliminar cliente?', $button = 'fa-recycle';
    protected $listeners = ['update_client_table' => 'render'];
    public function render()
    {
       
        if ($this->is_active == 1) {
            $clients = Client::search($this->search)
                ->orderBy($this->order, $this->direction)->paginate(10);
        } else {
            $clients = Client::onlyTrashed()->search($this->search)
                ->orderBy($this->order, $this->direction)->paginate(10);
        }
        return view('livewire.client-table')->with(['clients'=>$clients]);
    }
    public function toggle()
    {
        if ($this->is_active == 1) {
            $this->is_active = 0;
            $this->title = 'Productos eliminados';
            $this->icon = 'fa-sync-alt text-blue-500';
            $this->confirm = '¿Restaurar cliente?';
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
    public function updatedPlaceid()
    {
        $this->resetPage();
    }
    public function softdelete($client)
    {
        $client=Client::withTrashed()->where('slug','=',$client)->first();
       if ($client->deleted_at==null) {
        $client->delete();
       } else {
        $client->restore();
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
