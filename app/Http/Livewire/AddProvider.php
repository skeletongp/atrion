<?php

namespace App\Http\Livewire;

use App\Models\Day;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class AddProvider extends Component
{
    public $roles, $name, $phone, $meta, $days = [], $debt=0;
    protected $listeners = ['multi' => 'multi'];
    
    protected $rules = [
        "name" => "required|max:50:unique:providers, name",
        "phone" => "required|",
        "meta" => "required",

    ];
    public function render()
    {
        $this->days=json_decode(json_encode($this->days));
        return view('livewire.add-provider');
    }
    public function multi($value)
    {
        $this->days = $value;
    }
    public function store()
    {
        if (Auth::user()->can('Gestionar Suplidores')) {
            $this->validate();
            $provider= new Provider();
            $provider->name=$this->name;
            $provider->slug=Str::slug($this->name);
            $provider->meta=$this->meta;
            $provider->debt=$this->debt;
            $provider->phone=$this->phone;
           
            if ( $provider->save()) {
            $days=Day::wherein('name',$this->days)->get();
            $provider->days()->sync($days);
            session()->flash('added', 'Usuario añadido');
            $this->reset('name', 'phone', 'days', 'meta');
            $this->emit('update_provider_table');
            } else {
                alert('Ha ocurrido un error','Revise e intente nuevamente', 'error');
            }
            
        }
    }
}
