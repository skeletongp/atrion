<?php

namespace App\Http\Livewire;

use App\Models\Place;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class EditPlace extends Component
{
    public $open=false;
    public $place, $name, $phone, $location, $message;
    public function render()
    {
        
        $this->name=$this->place->name;
        $this->phone=$this->place->phone;
        $this->location=$this->place->location;

        return view('livewire.edit-place');
    }
    protected $rules=[
        "name"=>"required|string",
        "phone"=>"required",
        "location"=>"required|max:60",

    ];
    public function update($place)
    {
        $place=Place::withTrashed()->where('slug','=',$place)->first();
        $this->validate();
        $place->name=$this->name;
        $place->phone=$this->phone;
        $place->location=$this->location;
        $place->slug=Str::slug($this->name);
        $place->edited_by =Auth::user()->id;
        $place->save();
        $this->place=$place;
        $this->render();
        $this->emit('update_place_table');
    }
}
