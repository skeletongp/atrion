<?php

namespace App\View\Components;

use Illuminate\View\Component;

class input_text extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name, $label, $oldValue, $placehoder, $type, $readonly, $model;
    public function __construct($name, $label, $oldValue, $placehoder, $type, $readonly, $model)
    {
        $this->name=$name;
        $this->label=$label;
        $this->oldValue=$oldValue;
        $this->placehoder=$placehoder;
        $this->type=$type;
        $this->readonly=$readonly;
        $this->model=$model;
       
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input_text');
    }
}
