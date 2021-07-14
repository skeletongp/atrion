<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;

class DataCard extends Component
{
    public $data, $route, $param, $edit, $destroy, $object;
    public $title, $title2, $subtitle, $data1, $data2;
    public $icon, $icon1, $icon2, $icon3, $icon4;
    public $confirm="¿Desea eliminar el registro?";
    
   
    public function render()
    {
        $this->object->is_active==1?
        $this->confirm="¿Desea eliminar el registro?":
        $this->confirm="¿Desea restaurar el registro?";
        return view('livewire.data-card');
    }
}
