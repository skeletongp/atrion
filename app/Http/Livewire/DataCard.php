<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class DataCard extends Component
{
    public $data, $route, $param, $edit, $destroy, $object, $status;
    public $title, $title2, $subtitle, $data1, $data2;
    public $icon, $icon1, $icon2, $icon3, $icon4;
    public $confirm="¿Desea eliminar el registro?";
    
   
    public function render()
    {
        $this->status==1?
        $this->confirm="¿Desea eliminar el registro?":
        $this->confirm="¿Desea restaurar el registro?";
        return view('livewire.data-card');
    }
    function softdelete()
    {
        $this->status==1?
        $this->object->deleted_at=date("Y-m-d h:i:s"):
        $this->object->deleted_at=null;
        $this->object->save();
        return redirect()->back();
    }
}
