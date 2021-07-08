<?php

namespace App\View\Components;

use Illuminate\View\Component;

class input_select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name, $label, $model, $placeholder, $button;
    public function __construct($name, $label, $model, $placeholder, $button="")
    {
        $this->name=$name;
        $this->label=$label;
        $this->model=$model;
        $this->placeholder=$placeholder;
        $this->boton=$button;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input_select');
    }
}
