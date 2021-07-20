<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PanelData extends Component
{
    public $title, $value, $icon1, $icon2, $bg1, $bg2;
    public function render()
    {
        return view('livewire.panel-data');
    }
}
