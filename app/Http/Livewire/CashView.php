<?php

namespace App\Http\Livewire;

use App\Models\Cash;
use App\Models\Income;
use Livewire\Component;

class CashView extends Component
{
    public $user, $cash;
    public function render()
    {
        $this->cash=Cash::where('place_id','=',$this->user->place_id)->first();
        $this->incomes=Income::where('place_id','=',$this->user->place_id)
        ->where('date','=',date('Y-m-d'));
        return view('livewire.cash-view');
    }
}
