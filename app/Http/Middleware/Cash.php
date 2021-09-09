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
            $cash=ModelsCash::where('local_ip','=',$this->getIp())
            ->where('date','=',date('Y-m-d'))
            ->where('status','=',1)->first();
            if($cash){
                return $next($request);
            } 
        }
        session()->flash('cashOut', 'Debe abrir la caja para operar');
        return redirect()->route('home');
    }
    public function getIp()
    {
        $myIp = md5(
            $_SERVER['REMOTE_ADDR'] .
            $_SERVER['HTTP_USER_AGENT']
        );;
        return $myIp;
    }
}
