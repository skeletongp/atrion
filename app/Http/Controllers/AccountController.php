<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function outcome_index()
    {
       return view('account.outcome');
    }
}
