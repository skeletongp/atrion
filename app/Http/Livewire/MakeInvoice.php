<?php

namespace App\Http\Livewire;

use App\Models\Cash;
use App\Models\Client;
use App\Models\Detail;
use App\Models\Income;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;
use stdClass;

class MakeInvoice extends Component
{
    public $clients, $products, $product;
    public $client_id, $name = "Nombre del Cliente", $phone = "000-000-0000";
    public $product_id, $price, $cant = 1, $discount = 0, $productName, $stock=0;
    public $list = [];
    public $totales = ['subtotal' => 0, 'discount' => 0, 'total' => 0, 'tax' => 0];
    protected $listeners = [
        'change',
        'render'
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
        return view('livewire.make-invoice');
    }
    public function change($val)
    {
        $this->product_id = $val;
        $this->product = Product::find($val);
        $this->price = $this->product->price;
        $this->stock = $this->product->stock;
        $this->productName = $this->product->name;
    }
    protected $rules = [
        'price' => 'required|numeric|min:1',
        'cant' => 'required|numeric|min:1|lte:stock',
        'discount' => 'required|numeric|min:0',
        'productName' => 'required|string',
    ];

    public function addDetail()
    {
        
        $this->validate();
        $productDetail = new stdClass();
        $productDetail->id = $this->product_id;
        $productDetail->price = round($this->price * 0.82, 2);
        $productDetail->tax = round($this->price * 0.18, 2)* $this->cant;
        $productDetail->subtotal = round($productDetail->price, 2) * $this->cant;
        $productDetail->discount = $this->discount;
        $productDetail->name = $this->productName;
        $productDetail->cant = $this->cant;
        $productDetail->name = $this->productName;
        $productDetail->total = round((($this->price * $this->cant) - $this->discount), 2);
        $productDetail = json_decode(json_encode($productDetail), true);
        $this->remove($productDetail['id']);
        array_push($this->list, $productDetail);
        $this->reset('product_id', 'price', 'cant', 'discount', 'productName',);
        $this->totales['subtotal'] += $productDetail['subtotal'];
        $this->totales['tax'] += $productDetail['tax'];
        $this->totales['total'] += $productDetail['total'];
        $this->totales['discount'] += $productDetail['discount'];
        $this->emit('update_details');
    }
    public function remove($id)
    {
        foreach ($this->list as $productDetail) {
            if ($productDetail['id'] == $id) {
                $this->totales['subtotal'] -= $productDetail['subtotal'];
                $this->totales['tax'] -= $productDetail['tax'];
                $this->totales['total'] -= $productDetail['total'];
                $this->totales['discount'] -= $productDetail['discount'];
                array_splice($this->list, array_search($productDetail, $this->list), 1);
            }
        }
    }
    public function charge($id)
    {
        foreach ($this->list as $productDetail) {
            if ($productDetail['id'] == $id) {
                $this->change($productDetail['id']);
                $this->product_id = $productDetail['id'];
                $this->cant = $productDetail['cant'];
                $this->discount = $productDetail['discount'];
                array_splice($this->list, array_search($productDetail, $this->list), 1);
            }
        }
    }
    public function facturar()
    {
        if ($this->client_id > 0 && $this->totales['total'] > 0) {
            $invoice = new Invoice();
            $invoice->number = str_pad(Auth::user()->place->invoices->count() + 1, 5, '0', STR_PAD_LEFT);
            $invoice->date = date('Y-m-d');
            $invoice->subtotal = $this->totales['subtotal'];
            $invoice->tax = $this->totales['tax'];
            $invoice->total = $this->totales['total'];
            $invoice->ncf = 'NCF' . str_pad(Auth::user()->place->invoices->count() + 1, 8, '0', STR_PAD_LEFT);
            $invoice->user_id = Auth::user()->id;
            $invoice->place_id = Auth::user()->place_id;
            $invoice->client_id = $this->client_id;
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
                    $product->stock-=$productDetail['cant'];
                    $product->save();
                }
                $this->upIncome($invoice->total);
                $this->upCash(Auth::user()->place->cash->id, $invoice->total);
            }
        return redirect()->route('sale');
        }
    }
    public function upIncome($total)
    {
        $income= new Income();
        $income->user_id=Auth::user()->id;
        $income->place_id=Auth::user()->place_id;
        $income->client_id=$this->client_id;
        $income->cash_id=Auth::user()->place->cash->id;
        $income->amount=$total;
        $income->date=date('Y-m-d');
        $income->save();
    }
    public function upCash($cash, $total)
    {
        $cash=Cash::find($cash);
        $cash->end+=$total;
        $cash->save();
    }
    public function prove()
    {
        $pdf=PDF::loadview('pdfs.invoice');
        return $pdf->download('invoice.pdf');
    }
}
