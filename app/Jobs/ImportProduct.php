<?php

namespace App\Jobs;

use App\Imports\ProductsImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ImportProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $import, $ruta;
    public function __construct($import, $ruta)
    {
     $this->import=$import;
     $this->ruta=$ruta;
    }

    public function handle()
    {
        Excel::import($this->import, $this->ruta);
    }
}
