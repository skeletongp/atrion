<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class EditCompany extends Component
{
    public $name, $phone, $location, $rnc, $logo, $company;
    public $onEdit = false;
    protected $rules = [
        'name' => 'required|max:40',
        'location' => 'required|max:160',
        'rnc' => 'required',
        'phone' => 'regex:/[0-9]{3}-[0-9]{3}-[0-9]{4}/',

    ];
    public function render()
    {
        $this->company = Company::get()->first();
        $this->name = $this->company->name;
        $this->phone = $this->company->phone;
        $this->rnc = $this->company->rnc;
        $this->location = $this->company->location;
        return view('livewire.edit-company');
    }
    public function update()
    {
        if ($this->onEdit) {
            $this->validate();
            $this->logo = Str::slug($this->name, '-');
            $this->company->name = $this->name;
            $this->company->phone = $this->phone;
            $this->company->location = $this->location;
            $this->company->rnc = $this->rnc;
            $this->company->edited_by = Auth::user()->id;
            $this->company->logo = "https://ui-avatars.com/api/?name=" . $this->logo . "&color=FFFFFF&background=000000";
            $this->company->save();
            return redirect()->route('user.company');
        } else {
            $this->onEdit = true;
        }

        
    }
}
