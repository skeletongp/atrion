<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Detail;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
class InvoiceController extends Controller
{
    public function sale($cotize=false)
    {
        $cash=Cash::where('place_id','=',Auth::user()->place_id)->where('date','=',date('Y-m-d'))->where('status','=',1)->first();
        if ($cash) {
            return view('invoice.sale')->with('cotize',$cotize);
        } else {
           return redirect()->route('home');
        }
        
    }
    public function print()
    {
        
        /*  $pdf=PDF::loadview('pdfs.invoice');
        return $pdf->stream('invoice.pdf'); */
        $invoice=Invoice::where('id','>',1)->first();
        $details=Detail::where('invoice_id',$invoice->id)->get();
      return view('pdfs.invoice')->with(['invoice'=>$invoice, 'details'=>$details]);
    }
}
