<?php

namespace App\Http\Livewire;

use App\Models\Place;
use Livewire\Component;
use Illuminate\Support\Str;

class EditPlace extends Component
{
    public $open=false;
    public $place_id, $name, $phone, $location, $message;
    public function render()
    {
        $place=Place::where('id','=',$this->place_id)->first();
        $this->name=$place->name;
        $this->phone=$place->phone;
        $this->location=$place->location;

        return view('livewire.edit-place', compact('place'));
    }
    protected $rules=[
        "name"=>"required|string",
        "phone"=>"required",
        "location"=>"required|max:60",

    ];
    public function store(Place $place)
    {
        $this->validate();
        $place->name=$this->name;
        $place->phone=$this->phone;
        $place->location=$this->location;
        $place->slug=Str::slug($this->name);
        if ($place->save()) {
            $this->open=false;
        }
        $this->emit('success-update');
        $this->emit('place_updated');
    }
}
