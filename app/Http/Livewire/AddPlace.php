<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Place;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AddPlace extends Component
{
    public $roles, $name, $phone, $location;
    public $message;
    protected $rules=[
        "name"=>"required|unique:places,name|string",
        "phone"=>"required",
        "location"=>"required|max:60",

    ];
    public function render()
    {
        return view('livewire.add-place');
    }
    public function store()
    {
        $this->validate();
        $place= new Place();
        $place->name=$this->name;
        $place->phone=$this->phone;
        $place->location=$this->location;
        $place->slug=Str::slug($this->name);
        $place->save();
        $this->emit('message');
        return redirect()->route('places.index');
    }
}
