<?php

namespace App\View\Components;

use Illuminate\View\Component;

class modal extends Component
{
  public $title, $excel;
  public $modalId;
    public function __construct($modalId)
    {
      $this->modalId=$modalId;
    }

   
    public function render()
    {
        return view('components.modal');
    }
}
