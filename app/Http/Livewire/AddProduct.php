<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Place;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
class AddProduct extends Component
{
    public $name, $meta, $category_id, $place_id, $stock, $price, $cost;
    protected $listeners=['update_add_product'=>'render'];
    public function render()
    {
        $places=Place::orderBy('name')->get();
        $categories=Category::orderBy('name')->get();
        return view('livewire.add-product', compact('places', 'categories'));
    }
    protected $rules=[
        'name'=>'required|unique:products,name|max:50',
        'meta'=>'required|max:100',
        'category_id'=>'required',
        'place_id'=>'required',
        'stock'=>'required|min:0|numeric',
        'price'=>'required|min:0|numeric',
        'cost'=>'required|min:0|numeric',
    ];
    public function store()
    {
        $this->validate();
        $product= new Product();
        $product->name=$this->name;
        $product->meta=$this->meta;
        $product->category_id=$this->category_id;
        $product->place_id=$this->place_id;
        $product->stock=$this->stock;
        $product->price=$this->price;
        $product->cost=$this->cost;
        $product->slug=Str::slug($this->name);
        $product->save();
        $this->reset('name','meta','category_id','place_id','stock','price','cost');
        $this->emit('update_product_table');
    }
    public function toggle()
    {
        $this->emit('toggle-add-product');
    }
}
