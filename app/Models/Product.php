<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use HasFactory;
    use SearchableTrait, Sortable;
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function place()
    {
        return $this->belongsTo(Place::class);
    }
    public $sortable = [
        'id',
        'name',
        'cost',
        'price',
        'stock',
        'created_at',
        'updated_at'
    ];
    protected $searchable = [
       
        'columns' => [
            'products.name' => 10,
            'products.id' => 10,
            'products.cost' => 10,
            'products.price' => 2,
            'products.created_at' => 5,
            'products.updated_At' => 2,
            'categories.name' => 2,

        ]
        ,
        'joins' => [
            'categories' => ['products.category_id','categories.id'],
        ],
    ];
}
