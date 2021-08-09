<?php

namespace App\Http\Livewire;

use App\Models\Cash;
use App\Models\Client;
use App\Models\Cotdetail;
use App\Models\Cotize;
use App\Models\CXC;
use App\Models\Detail;
use App\Models\Fiscal;
use App\Models\Income;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;
use stdClass;

class MakeInvoice extends Component
{
    public $clients, $products, $product, $cotize=0;
    public $client_id, $name = "Nombre del Cliente", $phone = "000-000-0000";
    public $product_id, $price, $cant = 1, $discount = 0, $productName, $stock=0, $typeFiscal=0, $fiscal;
    public $list = [], $payed=0.0, $rest , $cashMoney=0.0, $other=0.0, $is_ncf=0, $ncf_id=0, $salor_id;
    public $totales = ['subtotal' => 0, 'discount' => 0, 'total' => 0, 'tax' => 0];
    protected $listeners = [
        'change'=>'change',
        'update_client_table'=>'update_clients'
    ];
    public function render()
    {

        $this->clients = Client::orderBy('name')->get();
        $this->products = Product::where('stock', '>', '0')
            ->where('place_id', '=', Auth::user()->place_id)
            ->orderBy('name')
            ->get();
        if ($this->client_id) {
            $client = Client::find($this->client_id);
            $this->name = $client->name;
            $this->phone = $client->phone;
        }
        $tipos=Fiscal::select('type')->groupBy('type')->get();
        $this->salor_id=Auth::user()->id;
        $salor=User::where('place_id',Auth::user()->place_id)
        ->orderBy('name')
        ->get();
        return view('livewire.make-invoice')->with(['tipos'=>$tipos, 'salor'=>$salor]);
    }

    /* Detecta la selección de un producto */
    public function change($val)
    {
        $this->product_id = $val;
        $this->product = Product::find($val);
        $this->price = $this->product->price;
        if ($this->product->is_product==1) {
            $this->stock = $this->product->stock;
        } else {
            $this->stock = round(1000000/$this->product->price, 2);
        }
        
        $this->productName = $this->product->name;
     
    }

    /* Validaciones */
    protected $rules = [
        'price' => 'required|numeric|min:1',
        'cant' => 'required|numeric|min:1|lte:stock',
        'discount' => 'required|numeric|min:0',
        'productName' => 'required|string',
    ];

    /* Añade el producto a la lista para facturar */
    public function addDetail()
    {
        
        $this->validate();
        $productDetail = new stdClass();
        $productDetail->id = $this->product_id;
        $productDetail->price = $this->price * 0.82;
        $productDetail->tax = ($this->price * 0.18)* $this->cant;
        $productDetail->subtotal = ($productDetail->price) * $this->cant;
        $productDetail->discount = $this->discount;
        $productDetail->name = $this->productName;
        $productDetail->cant = $this->cant;
        $productDetail->name = $this->productName;
        $productDetail->total = (($this->price * $this->cant));
        $productDetail = json_decode(json_encode($productDetail), true);
        $this->getTotals($productDetail,$productDetail['id']);
        array_push($this->list, $productDetail);
        $this->reset('product_id', 'price', 'cant', 'discount', 'productName',);
        $this->getTotals($productDetail, "suma");
        $this->emit('update_details');
    }

    /* Calcula los totales, al añadir $op debe decir sumar.
    Al eliminar, $op debe ser el id del producto */
    public function getTotals($productDetail, $op)
    {
        if ($op=="suma") {
            $this->totales['subtotal'] += $productDetail['subtotal'];
            $this->totales['tax'] += $productDetail['tax'];
            $this->totales['total'] += $productDetail['total'];
            $this->totales['discount'] += $productDetail['discount'];
            $this->totales['total']-=$this->totales['discount'];
            $this->payed=round($this->totales['total'],2);
        } else {
            foreach ($this->list as $productDetail) {
                if ($productDetail['id'] == $op) {
                    $this->totales['subtotal'] -= $productDetail['subtotal'];
                    $this->totales['tax'] -= $productDetail['tax'];
                    $this->totales['total'] -= $productDetail['total'];
                    $this->totales['discount'] -= $productDetail['discount'];
                    $this->payed=round($this->totales['total'],2);
                    array_splice($this->list, array_search($productDetail, $this->list), 1);
                }
            }
            $this->payed=$this->totales['total'];
        }
        $this->cashMoney=round($this->totales['total'], 2);
    }
    /* Carga el producto a los inputs para editarlo y lo borra de la lista */
    public function charge($id)
    {
        foreach ($this->list as $productDetail) {
            if ($productDetail['id'] == $id) {
                $this->change($productDetail['id']);
                $this->product_id = $productDetail['id'];
                $this->cant = $productDetail['cant'];
                $this->discount = $productDetail['discount'];
                array_splice($this->list, array_search($productDetail, $this->list), 1);
                $this->totales['subtotal'] -= $productDetail['subtotal'];
                    $this->totales['tax'] -= $productDetail['tax'];
                    $this->totales['total'] -= $productDetail['total'];
                    $this->totales['discount'] -= $productDetail['discount'];
                    $this->payed=round($this->totales['total'],2);
            }
        }
    }
    /* Facturacíón de los productos en la lista */
    public function facturar()
    {
        if ($this->client_id > 0 && $this->totales['total'] > 0) {
            $this->cobrar();
            $this->createAccount();
            if ($this->is_ncf==1) {
                $type=Fiscal::where('type',"=",$this->typeFiscal)->orderBy('ncf','asc')->first();
                $this->ncf_id=$type->id;
                $type->delete();
            }
            $invoice = new Invoice();
            $invoice->number = str_pad(Auth::user()->place->invoices->count() + 1, 5, '0', STR_PAD_LEFT);
            $invoice->date = date('Y-m-d');
            $invoice->subtotal = $this->totales['subtotal'];
            $invoice->tax = $this->totales['tax'];
            $invoice->total = $this->totales['total'];
            $invoice->user_id = Auth::user()->id;
            $invoice->salor_id = $this->salor_id;
            $invoice->place_id = Auth::user()->place_id;
            $invoice->client_id = $this->client_id;
            $invoice->payed = $this->payed;
            $invoice->cash_id = Auth::user()->place->cash->id;
            $invoice->rest = $this->rest;
            if ($this->ncf_id>0) {
                $invoice->fiscal_id = $this->ncf_id;
            }
            $invoice->cash = $this->cashMoney;
            $invoice->other = $this->other;
            $invoice->is_fiscal = $this->is_ncf;
            $this->fillDetail($invoice);
           
        return redirect()->route('preview', $invoice);
        }
    }
    /* Crea una cotización a partir de los productos listados */
    public function cotizar()
    {
        if ($this->client_id > 0 && $this->totales['total'] > 0) {
          
            $cotize = new Cotize();
            $cotize->number = str_pad(Auth::user()->place->cotizes->count() + 1, 5, '0', STR_PAD_LEFT);
            $cotize->date = date('Y-m-d');
            $cotize->subtotal = $this->totales['subtotal'];
            $cotize->tax = $this->totales['tax'];
            $cotize->total = $this->totales['total'];
            $cotize->user_id = Auth::user()->id;
            $cotize->cash_id = Auth::user()->place->cash->id;
            $cotize->place_id = Auth::user()->place_id;
            $cotize->client_id = $this->client_id;         
            $this->fillCotDetail($cotize);
           
        return redirect()->route('preview_cotize', $cotize);
        }
    }
    /* Registra el ingreso de la venta */
    public function upIncome()
    {
        $income= new Income();
        $income->user_id=Auth::user()->id;
        $income->place_id=Auth::user()->place_id;
        $income->client_id=$this->client_id;
        $income->cash_id=Auth::user()->place->cash->id;
        $income->amount=$this->payed;
        $income->date=date('Y-m-d');
        $income->save();
    }

    /* Guarda los detalles de la factura en su tabla */
    public function fillDetail($invoice)
    {
        if ($invoice->save()) {
            foreach ($this->list as $productDetail) {
                $detail = new Detail();
                $detail->cant = $productDetail['cant'];
                $detail->discount = $productDetail['discount'];
                $detail->price = $productDetail['price'];
                $detail->tax = $productDetail['tax'];
                $detail->total = $productDetail['total'];
                $detail->subtotal = $productDetail['subtotal'];
                $detail->product_id = $productDetail['id'];
                $detail->invoice_id = $invoice->id;
                $detail->save();
                $product=Product::find($productDetail['id']);
               $product->is_product==1? $product->stock-=$productDetail['cant']:'';
                $product->save();
            }
            $this->upIncome();
            $this->upCash(Auth::user()->place->cash->id, $invoice->total);
        }
    }

    /* Registra los detalles de la cotización */
    public function fillCotDetail($cotize)
    {
        if ($cotize->save()) {
            foreach ($this->list as $productDetail) {
                $detail = new Cotdetail();
                $detail->cant = $productDetail['cant'];
                $detail->discount = $productDetail['discount'];
                $detail->price = $productDetail['price'];
                $detail->tax = $productDetail['tax'];
                $detail->total = $productDetail['total'];
                $detail->subtotal = $productDetail['subtotal'];
                $detail->product_id = $productDetail['id'];
                $detail->cotize_id = $cotize->id;
                $detail->save();
               
            }
           
        }
    }
    /* Ingresa el monto de la venta en la caja - Lo que pagó el cliente */
    public function upCash($cash, $total)
    {
        $cash=Cash::find($cash);
        $cash->end+=$this->cashMoney;
        $cash->save();
    }
    
    /* Recibe el monto que pagó el cliente 
    y actualiza la deuda del cliente*/
    public function cobrar()
    {
        $this->payed=floatval($this->cashMoney)+floatval($this->other);
        $this->validate([
            'cashMoney'=>'required|min:0',
            'other'=>'required|min:0',
        ]);
        if ($this->payed>$this->totales['total']) {
           $this->cashMoney=$this->totales['total']-$this->other;
           $this->payed=$this->cashMoney+$this->other;
        }
        if ($this->totales['total']>$this->payed) {
            $this->rest=$this->totales['total']-$this->payed;
        } elseif ($this->totales['total']<=$this->payed) {
            $this->rest=0;
            $this->payed=$this->totales['total'];
        }
        else{
            $this->rest=0;
        }
        $client=Client::find($this->client_id);
        $client->debt+=$this->rest;
        $client->save();
    }
    /* Si el cliente queda debiendo, registra la deuda */
    public function createAccount()
    {
       if($this->rest>0){
           $account=new CXC();
           $account->client_id=$this->client_id;
           $account->amount=$this->rest;
           $account->balance=$this->rest;
           $account->save();

       }
    }
    public function update_clients()
    {
        $this->clients = Client::orderBy('name')->get();
    }
   
}
