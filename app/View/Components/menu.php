<?php

namespace App\View\Components;

use App\Models\Cash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class menu extends Component
{
    
    public function __construct()
    {
        date_default_timezone_set('America/Santo_Domingo');
    }

    
    public function render()
    {
        $cash=Cash::where('place_id','=',Auth::user()->place_id)->where('date','=',date('Y-m-d'))->first();;
        return view('components.menu')->with('cash',$cash);
    }
}
