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
    public $is_active = 1, $title = 'Productos activos', $icon = "fa-trash text-red-500", $confirm = '¿Eliminar producto?', $button = 'fa-recycle';
    protected $listeners = ['update_product_table' => 'render'];
    public function render()
    {
        $fiscals=Fiscal::paginate(10);
        return view('livewire.fiscal-table', compact('fiscals'));
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
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedPlaceid()
    {
        $this->resetPage();
    }
    public function softdelete(Product $product)
    {
        $product->delete();
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
}