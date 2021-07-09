<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class multiselect extends Component
{
   
    public $table, $name, $label;
    public function __construct($table, $name, $label)
    {
        $this->table=$table;
        $this->name=$name;
        $this->label=$label;
    }

   
    public function render()
    {
        $object=DB::select('select * from '.$this->table.'');
        return view('components.multiselect', compact('object'));
    }
}
