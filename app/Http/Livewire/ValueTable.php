<?php

namespace App\Http\Livewire;

use App\Models\Place;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class ValueTable extends Component
{
    use WithPagination;

    public $search = "", $direction = 'asc', $order = "name", $icon_order = 'fa-sort-up', $number=1, $type, $cant=10;
    public $cost, $price, $place_id=1;
    protected $listeners = ['update_product_table' => 'render'];
    public function render()
    {
        if ($this->type==null) {
            $this->type=1;
        }
        
            $products = Product::search($this->search)
                ->where('is_product', '=', $this->type)
                ->where('place_id', '=',$this->place_id)
                ->where('stock','>',0)
                ->orderBy($this->order, $this->direction, SORT_REGULAR, false)->paginate($this->cant);
        
        $places = Place::all();
        return view('livewire.value-table', compact('products', 'places'));
    }
    
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedPlaceid()
    {
        $this->resetPage();
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
    
}
