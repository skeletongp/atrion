<?php

namespace App\Http\Middleware;

use App\Models\Cash as ModelsCash;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cash
{
  
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $cash=ModelsCash::where('place_id','=',Auth::user()->place_id)
            ->where('date','=',date('Y-m-d'))
            ->where('status','=',1)->first();
            if($cash){
                return $next($request);
            } 
        }
        session()->flash('cashOut', 'Debe abrir la caja para operar');
        return redirect()->route('home');
    }
}
