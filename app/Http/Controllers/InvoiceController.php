<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Company;
use App\Models\Cotdetail;
use App\Models\Cotize;
use App\Models\Detail;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Options;

class InvoiceController extends Controller
{
    public function sale($cotize = false)
    {
        $cash = Cash::where('place_id', '=', Auth::user()->place_id)->where('date', '=', date('Y-m-d'))->where('status', '=', 1)->first();
        if ($cash) {
            return view('invoice.sale')->with('cotize', $cotize);
        } else {
            return redirect()->route('home');
        }
    }
    public function preview(Invoice $invoice)
    {
        $details = Detail::where('invoice_id', $invoice->id)->get();
        $company=Company::first();
        $pdf = PDF::loadview('pdfs.preview_invoice', ['details' => $details, 'invoice' => $invoice, 'company'=>$company]);
        return $pdf->stream('invoice.pdf');

    }
    public function preview_cotize(Cotize $cotize)
    {
        $details = Cotdetail::where('cotize_id', $cotize->id)->get();
        $company=Company::first();
        $pdf = PDF::loadview('pdfs.preview_invoice', ['details' => $details, 'invoice' => $cotize, 'company'=>$company]);
        return $pdf->stream('invoice.pdf');

    }
    public function invoices()
    {
        return view('invoice.invoices');
    }
    public function cotizes()
    {
        return view('invoice.cotizes');
    }
    public function invoices_filter($client_id)
    {
        return view('invoice.invoices')->with('client_id',$client_id);
    }
}
