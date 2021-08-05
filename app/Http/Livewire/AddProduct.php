<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Place;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class AddProduct extends Component
{
    use WithPagination;
    public $name, $meta, $category_id=1, $place_id, $stock, $price, $cost, $is_product, $code;
    public $message;
    protected $listeners=['update_add_product'=>'render', 'store_product'=>'store'];
    protected $rules=[
        'name'=>'required|unique_with:products,place_id|max:40',
        'meta'=>'required|max:100',
        'category_id'=>'required',
        'place_id'=>'required',
        'stock'=>'required|min:0|numeric',
        'price'=>'required|min:0|numeric',
        'cost'=>'required|min:0|numeric',
    ];
    
    public function render()
    {
        if ($this->is_product==null) {
            $this->is_product=1;
        }
        $places=Place::orderBy('name')->get();
        $categories=Category::orderBy('name')->get();
        return view('livewire.add-product', compact('places', 'categories'));
    }
   
    public function store()
    {
        $this->validate();
        $product= new Product();
        $product->name=$this->name;
        $product->code=$this->code;
        $product->meta=$this->meta;
        $product->category_id=$this->category_id;
        $product->place_id=$this->place_id;
        $product->stock=$this->stock;
        $product->price=$this->price;
        $product->cost=$this->cost;
        $product->is_product=$this->is_product;
        $product->slug=Str::slug($this->name);
        $product->save();
        $this->message="Producto añadido";
        $this->reset('name','meta','category_id','place_id','stock','price','cost');
        $this->emit('update_product_table');
    }
    public function toggle()
    {
        $this->reset('message');
        $this->emit('toggle-add-product');
    }
    public function updatedIsproduct()
    {
       $this->is_product==1?'':$this->stock=1;
    }
}
