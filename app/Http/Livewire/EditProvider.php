<?php

namespace App\Http\Livewire;

use App\Models\Day;
use Livewire\Component;

class EditProvider extends Component
{
    public $name, $phone, $meta, $days=[], $notDays=[];
    public $provider;
    public function render()
    {
      
        
        return view('livewire.edit-provider');
    }
    public function mount()
    {
        $this->name=$this->provider->name;
        $this->meta=$this->provider->meta;
        $this->phone=$this->provider->phone;
       $this->notDays=['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        foreach ($this->provider->days as $day) {
            array_push($this->days, $day->name);
                
                $this->notDays=array_diff($this->notDays, [$day->name]);

        }
    }

    protected $rules=[
        'name'=>'required|string|max:50',
        'phone'=>'required|regex:/[0-9]{3}-[0-9]{3}-[0-9]{4}/',
        'meta'=>'required|string|max:255',
    ];

    public function select($day)
    {
        $this->notDays=array_diff($this->notDays, [$day]);
        array_push($this->days, $day);
    }
    public function removeDay($day)
    {
       $this->days=array_diff($this->days, [$day]);
       array_push($this->notDays, $day);
    }
    public function update()
    {
        $provider=$this->provider;
        $this->validate();
        $provider->name=$this->name;
        $provider->meta=$this->meta;
        $provider->phone=$this->phone;
        $provider->save();
        $days=Day::wherein('name',$this->days)->get();
        $provider->days()->sync($days);
        $this->emit('update_provider_table');
    }
}
