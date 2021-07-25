<?php

namespace App\Jobs;

use App\Models\Fiscal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddFiscal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

      public $serie, $type_number, $type_text, $start, $cant;
    public function __construct($serie, $type_number, $type_text, $start, $cant)
    {
        $this->serie=$serie;
        $this->type_number=$type_number;
        $this->type_text=$type_text;
        $this->start=$start;
        $this->cant=$cant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        for ($i=$this->start; $i <$this->start+$this->cant ; $i++) { 
            $fiscal=new Fiscal();
            $fiscal->serie=$this->serie;

            $fiscal->type_number=$this->type_number;
            $fiscal->type=$this->type_text;
            $fiscal->secuency=str_pad($i, 8, '0', STR_PAD_LEFT);
            $fiscal->ncf=$this->serie.'-'.$this->type_number.'-'.str_pad($i, 8, '0', STR_PAD_LEFT);
            $fiscal->save();

        }
        return redirect()->route('fiscal_index');
    }
}
