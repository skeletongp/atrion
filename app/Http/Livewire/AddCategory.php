<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class AddCategory extends Component
{
    public $open=false;
    public $name, $meta;
    public function render()
    {
        return view('livewire.add-category');
    }
    protected $rules=[
        'name'=>'required|unique:products,name|max:50',
        'meta'=>'required|max:100',
    ];
    public function store()
    {
        $this->validate();
        $category= new Category();
        $category->name=$this->name;
        $category->meta=$this->meta;
        $category->is_active=1;
        $category->save();
        $this->reset('name','meta');
        $this->open=false;
        $this->emit('update_add_product');
    }
}
