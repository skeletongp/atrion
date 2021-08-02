<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

use function PHPUnit\Framework\isNull;

class multiselect extends Component
{
   
    public $table, $name, $label, $group, $placeholder;
    public function __construct($table, $name, $label, $group=[], $placeholder="Permisos de usuario")
    {
        $this->table=$table;
        $this->name=$name;
        $this->label=$label;
        $this->group=$group;
        $this->placeholder=$placeholder;
    }

   
    public function render()
    {
       if ($this->group==[]) {
        $object=DB::select('select * from '.$this->table.'');
          
       } else {
        $object=$this->group;
       }
       
        return view('components.multiselect', compact('object'));
    }
}
