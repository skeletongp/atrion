<?php

namespace App\Http\Livewire;

use App\Models\Outcome;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OutcomeTable extends Component
{
    use WithPagination;

    public $search = "", $direction = 'asc', $order = "name", $icon_order = 'fa-sort-up', $place_id, $type;
    public $is_active = 1, $title = 'Productos activos', $icon = "fa-trash text-red-500", $confirm = '¿Eliminar producto?', $button = 'fa-recycle';
    protected $listeners = ['update_outcome_table' => 'render'];
    public function render()
    {
        if($this->is_active==1){
            $outcomes=Outcome::search($this->search)
            ->where('place_id','=',Auth::user()->place_id)->paginate(10);
        }else{
            $outcomes=Outcome::onlyTrashed()->search($this->search)
            ->where('place_id','=',Auth::user()->place_id)->paginate(10);
        }
        return view('livewire.outcome-table')->with(['outcomes'=>$outcomes]);
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
    public function softdelete(Outcome $outcome)
    {
        $outcome->delete();
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
