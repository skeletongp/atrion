<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class EditClient extends Component
{
    public $name, $phone, $client, $rnc;
    public function render()
    {
        $this->name=$this->client->name;
        $this->phone=$this->client->phone;
        $this->rnc=$this->client->rnc;
        return view('livewire.edit-client');
    }
    protected $rules = [
        "name" => "required",
        "rnc"=>"required",
        "phone" => "required|regex:/[0-9]{3}-[0-9]{3}-[0-9]{4}/",

    ];
    public function update($client)
    {
        $client=Client::withTrashed()->where('slug','=',$client)->first();
        $this->validate();
        $client->name = $this->name;
        $client->phone = $this->phone;
        $client->rnc = $this->rnc;
        $client->slug = Str::slug($this->name);
        $client->save();

        session()->flash('added', 'Cliente añadido');
        $this->reset('name', 'phone');
        $this->client=$client;
        $this->emit('update_client_table');
    }
}
