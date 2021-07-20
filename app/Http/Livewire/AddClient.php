<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Illuminate\Support\Str;

class AddClient extends Component
{
    public $name, $phone, $debt=0;
    protected $listeners=['multi'=>'multi'];
    protected $rules=[
        "name"=>"required|unique:clients,name",
        "phone"=>"required|regex:/[0-9]{3}-[0-9]{3}-[0-9]{4}/",

    ];
    public function render()
    {        
        return view('livewire.add-client');
    }
    public function store()
    {
        $this->validate();
        $client= new Client();
        $client->name=$this->name;
        $client->phone=$this->phone;
        $client->debt=$this->debt;
        $client->slug=Str::slug($this->name);
        $client->save();
      
        session()->flash('added', 'Cliente añadido');
        $this->reset('name','phone','debt');
        $this->emit('update_client_table');
        
    }
}
