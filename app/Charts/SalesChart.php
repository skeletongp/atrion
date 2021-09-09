<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesChart extends BaseChart
{
    public function getIp()
    {
        $myIp = md5(
            $_SERVER['REMOTE_ADDR'] .
            $_SERVER['HTTP_USER_AGENT']
        );
        return $myIp;
    }
    public function handler(Request $request): Chartisan
    {
        $arr_labels=[];
        $arr_data1=[];
        $incomes=Auth::user()->cashes->where('local_ip','=',$this->getIp());
       foreach ($incomes as $income) {
         if($income->date>now()->subDays(7)){
            array_push($arr_labels, date_format(date_create($income->date), 'd-m-Y'));
            array_push($arr_data1, $income->end);
         }
       }
        return Chartisan::build()
            ->labels($arr_labels)
            ->dataset('Ingresos de la semana', $arr_data1);
    }
}