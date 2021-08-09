<?php

namespace App\Http\Livewire;

use App\Models\Fiscal;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Place;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class FiscalTable extends Component
{
    use WithPagination;

    public $search = "", $direction = 'asc', $order = "name", $icon_order = 'fa-sort-up', $place_id, $type;
    protected $listeners = ['update_product_table' => 'render'];
    public function render()
    {
        $fiscals=Fiscal::withTrashed()->search($this->search)->orderBy('ncf')->paginate(10);
        return view('livewire.fiscal-table', compact('fiscals'));
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
    public function store()
    {
        $this->emit('store_product');
    }
}
