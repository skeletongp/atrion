<?php

namespace App\Http\Livewire;

use App\Models\Cash;
use App\Models\Income;
use App\Providers\RouteServiceProvider;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CashView extends Component
{
    public $user, $cash;
    public $amount;
    public function render()
    {
        $date = Carbon::now()->subDays(7);
        $dates = Income::where('date', '>=', $date)->groupBy('date')->where('place_id', Auth::user()->place_id)->get();
        $sales = Income::where('date', '>=', $date)->selectRaw('sum(amount) as end')->groupBy('date')->where('place_id', Auth::user()->place_id)->get();
        $this->cash = Auth::user()->activeCash;
        $this->incomes = Income::where('place_id', '=', Auth::user()->place_id)
            ->where('date', '=', date('Y-m-d'));
            
        return view('livewire.cash-view')->with(['dates' => json_encode($dates, JSON_NUMERIC_CHECK), 'sales' => json_encode($sales, JSON_NUMERIC_CHECK)]);
    }
    public function getIp()
    {
        $myIp = md5(
            $_SERVER['REMOTE_ADDR'] .
            $_SERVER['HTTP_USER_AGENT']
        );
        return $myIp;
    }
    protected $rules = [
        'amount' => 'required|numeric|min:1'
    ];
    public function open(Cash $cash)
    {
        if ($this->cash) {
            
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            $this->validate();
            foreach (Cash::where('status','=',1)
            ->where('local_ip','=',$this->getIp())
            ->get() as $cash) {
               $cash->status=0;
               $cash->edited_by=Auth::user()->id;
               $cash->save();
            }
            $cash = new Cash();
            $cash->date = date('Y-m-d');
            $cash->user_id = Auth::user()->id;
            $cash->place_id = Auth::user()->place_id;
            $cash->local_ip = $this->getIp();
            $cash->start = $this->amount;
            $cash->end = $this->amount;
            $cash->save();
            View::share('cash', $cash);
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    public function close()
    {
        $this->cash->status = 0;
        $this->cash->edited_by=Auth::user()->id;
        $this->cash->save();
        View::share('cash', null);
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function reopen(Cash $cash)
    {
        $cash->status = 1;
        $cash->edited_by=Auth::user()->id;
        $cash->save();
        View::share('cash', $cash);
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    public function confirmar(Cash $cash)
    {
        if ($cash->id > 0) {
            $this->emit('reopenClick');
        } else {
            return false;
        }
    }
}
