<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Place;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

class ProductTable extends Component
{
    use WithPagination;

    public $search = "", $direction = 'asc', $order = "name", $icon_order = 'fa-sort-up', $place_id, $type="Todos", $cant, $amount=10, $category='Todas';
    public $is_active = 1, $title = 'Productos activos', $icon = "fa-trash text-red-500", $confirm = '¿Eliminar producto?', $button = 'fa-recycle';
    protected $listeners = ['update_product_table' => 'render'];
    public function render()
    {
        if ($this->type=='Todos') {
            $type='';
        } else{
            $type=$this->type;
        }
        if ($this->category=='Todas') {
            $category='';
        } else{
            $category=$this->category;
        }
        if ($this->place_id == null) {
            $this->place_id = Auth::user()->place_id;
        }
        if ($this->is_active == 1) {
            $products = Product::search($this->search)
                ->where('type', 'like','%'.$type)
                ->where('place_id', '=', $this->place_id)
                ->where('category_id','like','%'.$category)
                ->orderBy($this->order, $this->direction, SORT_REGULAR, false)->paginate($this->amount);
        } else {
            $products = Product::onlyTrashed()->search($this->search)
                ->where('type', '=', $this->type)
                ->where('place_id', '=', $this->place_id)
                ->orderBy($this->order, $this->direction)->paginate($this->amount);
        }
        $places = Place::all();
        $categories = Category::all();
        return view('livewire.product-table', compact('products', 'places','categories'));
    }
    public function toggle()
    {
        if ($this->is_active == 1) {
            $this->is_active = 0;
            $this->title = 'Productos eliminados';
            $this->icon = 'fa-sync-alt text-blue-500';
            $this->confirm = '¿Restaurar producto?';
            $this->button = 'fa-reply-all';
        } else {
            $this->reset('is_active', 'title', 'icon', 'confirm', 'button');
        }
    }
   
        public function softdelete( $product)
    {
        $product=Product::withTrashed()->where('slug','=',$product)->first();

        if($product->deleted_at==null){
            $product->delete();
        } else{
            $product->restore();
        }
        $this->render();
        $this->render();
    }
    public function search()
    {
        $this->render();
    }
    public function order($order)
    {
        $this->order = $order;
        if ($this->direction == 'asc') {
            $this->direction = "desc";
            $this->icon_order = 'fa-sort-down';
        } else {
            $this->direction = "asc";
            $this->icon_order = 'fa-sort-up';
        }
        $this->resetPage();
    }
    public function store()
    {
        $this->emit('store_product');
    }
    public function printCodes()
    {
        return redirect()->route('printCodes');
    }
    public function add(Product $product)
    {
        $this->validate([
            'cant'=>'required|numeric|min:1'
        ]);
        $product->stock=$product->stock+$this->cant;
        $product->save();
        $this->reset('cant');
    }
}
