<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Outcome;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddOutcome extends Component
{
    public $concept, $amount, $reference, $provider_id, $client_id;

    protected $listeners=['update_provider_table'=>'render'];
    public function render()
    {
        $invoices=null;
        $providers=Provider::get();
        $clients=Client::whereHas('invoices')->get();
        $client=Client::find($this->client_id);
        if($client){
            $invoices=$client->invoices;
        }
        return view('livewire.add-outcome')->with(['providers'=>$providers, 'clients'=>$clients,'invoices'=>$invoices]);
    }
    protected $rules=[
        'concept'=>'required|string',
        'amount'=>'required|numeric|min:0',
        'reference'=>'required|string|max:30',
    ];
    public function store()
    {
        $this->validate();
        $user_id=Auth::user()->id;
        $place_id=Auth::user()->place_id;
        $outcome= new Outcome();
        $outcome->user_id=$user_id;
        $outcome->place_id=$place_id;
        $outcome->client_id=$this->client_id;
        $outcome->provider_id=$this->provider_id;
        $outcome->amount=$this->amount;
        $outcome->concept=$this->concept;
        $outcome->reference=strval($this->reference);
        $outcome->save();
        if ($this->concept=='Devolución') {
            $this->deleteInvoice($this->reference);
        }
        $this->reset('concept','amount','reference','provider_id','client_id');
        $this->emit('update_outcome_table');
        

    }
    public function deleteInvoice($invoice)
    {
        $invoice=Invoice::find($invoice);
        if ($invoice && $this->amount+$invoice->refund>=$invoice->payed) {
            $invoice->refund=$invoice->refund+$this->amount;
            $invoice->edited_by=Auth::user()->id;
            $invoice->save();
            $invoice->delete();
        } else if($invoice){
            $invoice->refund=$invoice->refund+$this->amount;
            $invoice->edited_by=Auth::user()->id;
            $invoice->save();
        }
    }
}
