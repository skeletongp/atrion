<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Place;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;

class EditProduct extends Component
{
    public $name, $meta, $category_id=1, $place_id, $stock, $price, $cost;
    public $product, $message;
    public function render()
    {
        $places=Place::orderBy('name')->get();
        $categories=Category::orderBy('name')->get();
        $this->category_id=$this->product->category_id;
        $this->place_id=$this->product->place_id;
        $this->name=$this->product->name;
        $this->meta=$this->product->meta;
        $this->stock=$this->product->stock;
        $this->price=$this->product->price;
        $this->cost=$this->product->cost;
        return view('livewire.edit-product')->with(['places'=>$places, 'categories'=>$categories]);
    }
    protected $rules=[
        'name'=>'required|max:50',
        'meta'=>'required|max:100',
        'category_id'=>'required',
        'place_id'=>'required',
        'stock'=>'required|min:0|numeric',
        'price'=>'required|min:0|numeric',
        'cost'=>'required|min:0|numeric',
    ];
    public function update(Product $product)
    {
        $this->validate();
        $product->name=$this->name;
        $product->meta=$this->meta;
        $product->category_id=$this->category_id;
        $product->place_id=$this->place_id;
        $product->stock=$this->stock;
        $product->price=$this->price;
        $product->cost=$this->cost;
        $product->slug=Str::slug($this->name);
        $product->save();
        $this->message="Producto editado";
        $this->product=$product;
        $this->reset('name','meta','category_id','place_id','stock','price','cost');
        $this->emit('update_product_table');
    }
}
