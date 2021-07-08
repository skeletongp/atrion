<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductTable extends Component
{
    use WithPagination;
    public $search="";
    public $is_active=1, $title='Productos activos', $icon="fa-trash text-red-500", $confirm='¿Eliminar producto?', $button='fa-recycle';
    protected $listeners=['update_product_table'=>'render'];
    public function render()
    {
        $products=Product::where(function ($search)
        {
            $search->where('name','like','%'.$this->search.'%')
            ->orWhere('meta','like','%'.$this->search.'%');
        })
        ->where('is_active','=', $this->is_active)        
        ->paginate(5);
        return view('livewire.product-table', compact('products'));
    }
    public function toggle()
    {
        if ($this->is_active==1) {
            $this->is_active=0;
            $this->title='Productos eliminados';
            $this->icon='fa-sync-alt text-blue-500';
            $this->confirm='¿Restaurar producto?';
            $this->button='fa-reply-all';
        }
        else{
            $this->reset('is_active','title','icon','confirm', 'button');
           
        }
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function softdelete(Product $product)
    {
        $product->is_active==1? $product->is_active=0: $product->is_active=1;
        $product->save();
        $this->render();
    }
}
