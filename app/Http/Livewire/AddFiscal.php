<?php

namespace App\Http\Livewire;

use App\Jobs\AddFiscal as JobsAddFiscal;
use App\Models\Fiscal;
use Livewire\Component;

class AddFiscal extends Component
{
    public $serie, $type, $secuency, $start, $cant;
    public $types = [
        [
            "id" => '01',
            "text" => "Factura de Crédito Fiscal",
        ],
        [
            "id" => '02',
            "text" => "Factura de Consumo",
        ],
        [
            "id" => '03',
            "text" => "​Notas de Débito",
        ],
        [
            "id" => '04',
            "text" => "Notas de Crédito",
        ],
        [
            "id" => '11',
            "text" => "Comprobante de Compras",
        ],
        [
            "id" => '12',
            "text" => "Registro Único de Ingresos",
        ],
        [
            "id" => '13',
            "text" => "Comprobante para Gastos Menores",
        ],
        [
            "id" => '14',
            "text" => "Comprobante de Regímenes Especiales",
        ],
        [
            "id" => '15',
            "text" => "Comprobante Gubernamental",
        ],
        [
            "id" => '16',
            "text" => "Comprobante para exportaciones",
        ],
        [
            "id" => '17',
            "text" => "Comprobante para Pagos al Exterio",
        ],
        [
            "id" => 'e-CF',
            "text" => "Comprobante Fiscal Electrónico",
        ],

    ];
    public function render()
    {


        return view('livewire.add-fiscal');
    }
    public function add()
    {
        $type_number = "";
        $type_text = "";
        foreach ($this->types as $typ) {
            if ($typ['id'] == $this->type) {
                $type_number = $typ['id'];
                $type_text = $typ['text'];
                
            }
        }
        JobsAddFiscal::dispatch($this->serie, $type_number, $type_text, $this->start, $this->cant);
        
    }
}
