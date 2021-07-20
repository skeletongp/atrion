<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function sale($cotize=false)
    {
        return view('invoice.sale')->with('cotize',$cotize);
    }
}
