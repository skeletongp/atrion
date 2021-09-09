<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Cotize;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CotizeTable extends Component
{
    use WithPagination;
    public $search = " ", $direction = 'asc', $order = "date", $icon_order = 'fa-sort-up', $amount=10, $type="cotize";
    public $is_active = 1, $icon = "fa-trash text-red-500", $confirm = '¿Eliminar cotización?', $button = 'fa-recycle';
    protected $listeners = ['update_invoice_table' => 'render'];
    public $client_id;
    public function render()
    {       
        $invoices=Cotize::with('client','seller')->search($this->search)
        ->where('place_id','=',Auth::user()->place_id)
        ->where(function($query){
            $this->is_active==1?'':$query->onlyTrashed();
            $this->client_id>0?$query->where('client_id','=',$this->client_id):'';
        })
        ->orderBy($this->order, $this->direction)
        ->paginate($this->amount);
        return view('livewire.invoice-table')->with(['invoices'=>$invoices]);
    }
    
    public function updatedSearch()
    {
        $this->resetPage();
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
