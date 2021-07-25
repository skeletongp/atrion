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
    public $search = "", $direction = 'asc', $order = "date", $icon_order = 'fa-sort-up', $amount=10;
    public $is_active = 1, $title = 'Facturas activas', $icon = "fa-trash text-red-500", $confirm = '¿Eliminar factura?', $button = 'fa-recycle';
    protected $listeners = ['update_invoice_table' => 'render'];
    public $client_id;
    public function render()
    {
        if ($this->client_id>0) {
            if ($this->is_active == 1) {
                $invoices = Invoice::search($this->search)
                ->where('client_id','=',$this->client_id)
                ->where('place_id','=',Auth::user()->place_id)
                    ->orderBy($this->order, $this->direction)->paginate($this->amount);
            } else {
                $invoices = Invoice::onlyTrashed()->search($this->search)
                ->where('client_id','=',$this->client_id)
                ->where('place_id','=',Auth::user()->place_id)
                    ->orderBy($this->order, $this->direction)->paginate($this->amount);
            }
        } else {
            if ($this->is_active == 1) {
                $invoices = Invoice::search($this->search)
                ->where('type','=','sale')
                ->where('place_id','=',Auth::user()->place_id)
                    ->orderBy($this->order, $this->direction)->paginate($this->amount);
            } else {
                $invoices = Invoice::onlyTrashed()->search($this->search)
                ->where('type','=','sale')
                ->where('place_id','=',Auth::user()->place_id)
                    ->orderBy($this->order, $this->direction)->paginate($this->amount);
            }
        }
        
        return view('livewire.invoice-table')->with(['invoices'=>$invoices]);
    }
    public function toggle()
    {
        if ($this->is_active == 1) {
            $this->is_active = 0;
            $this->title = 'Facturas Eliminadas';
            $this->icon = 'fa-sync-alt text-blue-500';
            $this->confirm = '¿Restaurar factura?';
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
    public function softdelete($invoice)
    {
        $invoice=Invoice::withTrashed()->where('number','=',$invoice)->first();
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
