<?php

namespace App\Http\Livewire;

use App\Models\Cash;
use App\Models\Income;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class CashView extends Component
{
    public $user, $cash;
    public $amount;
    public function render()
    {
        $date = Carbon::now()->subDays(7);
        $dates = Income::where('date', '>=', $date)->groupBy('date')->where('place_id', $this->user->place_id)->get();
        $sales = Income::where('date', '>=', $date)->selectRaw('sum(amount) as end')->groupBy('date')->where('place_id', $this->user->place_id)->get();
        $this->cash = Cash::where('place_id', '=', $this->user->place_id)->where('date', '=', date('Y-m-d'))->first();
        $this->incomes = Income::where('place_id', '=', $this->user->place_id)
            ->where('date', '=', date('Y-m-d'));
        return view('livewire.cash-view')->with(['dates' => json_encode($dates, JSON_NUMERIC_CHECK), 'sales' => json_encode($sales, JSON_NUMERIC_CHECK)]);
    }
    protected $rules = [
        'amount' => 'required|numeric|min:1'
    ];
    public function open(Cash $cash)
    {

        $this->validate();
        $cash = new Cash();
        $cash->date = date('Y-m-d');
        $cash->user_id = $this->user->id;
        $cash->place_id = $this->user->place_id;
        $cash->start = $this->amount;
        $cash->end = $this->amount;
        $cash->save();
        View::share('cash', $cash);
        return redirect()->route('home');
    }
    public function close()
    {
        $this->cash->status = 0;
        $this->cash->save();
        View::share('cash', null);
        return redirect()->route('home');
    }

    public function reopen(Cash $cash)
    {
        $cash->status = 1;
        $cash->save();
        View::share('cash', $cash);
        return redirect()->route('home');
    }
    public function confirmar(Cash $cash)
    {
        if ($cash->id > 0) {
            $this->emit('reopenClick');
        } 
        else{
            return false;
        }
    }
}
