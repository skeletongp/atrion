<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FiscalController extends Controller
{
   public function fiscal_index()
   {
       return view('fiscal.fiscal_index');
   }
}
