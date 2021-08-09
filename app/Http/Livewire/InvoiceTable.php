<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceTable extends Component
{
    use WithPagination;
    public $search = "", $direction = 'asc', $order = "date", $icon_order = 'fa-sort-up', $amount=10, $type="invoice";
    public $is_active = 1, $title = 'Facturas activas', $icon = "fa-trash text-red-500", $confirm = '¿Eliminar factura?', $button = 'fa-recycle';
    protected $listeners = ['update_invoice_table' => 'render'];
    public $client_id;
    
    public function render()
    {
     
        if ($this->client_id>0) {
           
                $invoices = Invoice::withTrashed()->with('client','salor')->search($this->search)
                ->where('client_id','=',$this->client_id)
                ->where('place_id','=',Auth::user()->place_id)->where(function ($query)
                {
                    $query->orderBy($this->order, $this->direction);
                })->paginate($this->amount);

           
        } else {
           
                $invoices = Invoice::withTrashed()->search($this->search)
                ->where('place_id','=',Auth::user()->place_id)->where(function ($query)
                {
                    $query->orderBy($this->order, $this->direction);
                    
                })
                ->where('type','=','sale')
                ->where('place_id','=',Auth::user()->place_id)
                ->paginate($this->amount);
          
        }
        
        return view('livewire.invoice-table')->with(['invoices'=>$invoices]);
    }
    
    
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function softdelete($invoice)
    {
        $invoice=Invoice::withTrashed()->where('id','=',$invoice)->first();
        if($invoice->deleted_at==null){
            $invoice->delete();
        } else{
            $invoice->restore();
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
