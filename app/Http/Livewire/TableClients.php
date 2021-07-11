<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class TableClients extends Component
{
    
    use WithPagination;
    
    public $search="", $place_id, $order="name", $direction="asc";
    public $is_active=1, $title='Clientes activos', $icon="fa-trash text-red-500", $confirm='¿Eliminar cliente?', $button='fa-recycle';
    public function render()
    {
       

        $clients=Client::where(function ($search)
        {
            $search->Where('name','like','%'.$this->search.'%')
            ->orWhere('phone','like','%'.$this->search.'%')
            ;
        })
        ->where('is_active','=', $this->is_active) 
        ->orderBy($this->order, $this->direction)
        ->paginate(5);
        return view('livewire.table-clients', compact('clients'));
    }
    public function softdelete(Client $client)
    {
        $client->is_active==1? $client->is_active=0: $client->is_active=1;
        $client->save();
        $this->render();
    }
    public function toggle()
    {
        if ($this->is_active==1) {
            $this->is_active=0;
            $this->title='Clientes eliminados';
            $this->icon='fa-sync-alt text-blue-500';
            $this->confirm='¿Restaurar cliente?';
            $this->button='fa-reply-all';
        }
        else{
            $this->reset('is_active','title','icon','confirm', 'button');
           
        }
    }
    public function toggleTitle()
    {
        if ($this->title=="Nuevo Cliente") {
            $this->reset('title');
        }else{
            $this->title="Nuevo Cliente";
        }
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function toggleOrder($order)
    {
        if($this->order!=$order){
            $this->direction="asc";
        } else{
            if ($this->direction=='asc') {
                $this->direction="desc";
            } else{
                $this->direction="asc";
            }
        }
        $this->order=$order;
        
    }
}
