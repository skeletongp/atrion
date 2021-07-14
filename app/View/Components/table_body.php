<?php

namespace App\View\Components;

use Illuminate\View\Component;

class table_body extends Component
{
    public $title, $thead;
    public function __construct($title)
    {
        $this->title=$title;
    }

    
    public function render()
    {
        return view('components.table_body');
    }
}
