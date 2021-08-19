<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    use SearchableTrait;
    const PRODUCTO='PRODUCTO';
    const SERVICIO='SERVICIO';
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }
    public function place()
    {
        return $this->belongsTo(Place::class)->withTrashed();
    }
    
    
    protected $searchable = [
       
        'columns' => [
            'products.name' => 10,
            'products.id' => 10,
            'products.cost' => 10,
            'products.meta' => 10,
            'products.price' => 2,
            'products.created_at' => 5,
            'products.updated_at' => 5,
            'categories.name' => 5,
            'places.name' => 5,
            'places.location' => 5,

        ]
        ,
        'joins' => [
            'categories' => ['products.category_id','categories.id'],
            'places' => ['products.place_id','places.id'],
        ],
    ];
    protected $guarded=[];
}
