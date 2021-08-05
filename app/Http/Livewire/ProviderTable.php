<?php

namespace App\Http\Livewire;

use App\Models\Provider;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ProviderTable extends Component
{
    use WithPagination;
    public $search = "", $direction = 'asc', $order = "name", $icon_order = 'fa-sort-up';
    public $is_active = 1, $title = 'Usuarios activos', $icon = "fa-trash text-red-500", $confirm = '¿Eliminar usuario?', $button = 'fa-recycle';
    protected $listeners = ['update_provider_table' => 'render'];
    public function render()
    {
        if ($this->is_active == 1) {
            $providers = Provider::search($this->search)
                
                ->orderBy($this->order, $this->direction)->paginate(10);
        } else {
            $providers = Provider::onlyTrashed()->search($this->search)
               
                ->orderBy($this->order, $this->direction)->paginate(10);
        }
        return view('livewire.provider-table')->with(['providers'=>$providers]);
    }
    public function toggle()
    {
        if ($this->is_active == 1) {
            $this->is_active = 0;
            $this->title = 'Usuarios eliminados';
            $this->icon = 'fa-sync-alt text-blue-500';
            $this->confirm = '¿Restaurar producto?';
            $this->button = 'fa-reply-all';
        } else {
            $this->reset('is_active', 'title', 'icon', 'confirm', 'button');
        }
        $this->resetPage();
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function softdelete($provider)
    {
        $provider=Provider::withTrashed()->where('slug','=',$provider)->first();

        if($provider->deleted_at==null){
            $provider->delete();
        } else{
            $provider->restore();
        }
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
            $this->icon_order='fa-sort-down';
        } else {
            $this->direction = "asc";
            $this->icon_order='fa-sort-up';

        }
        $this->resetPage();
    }
}
