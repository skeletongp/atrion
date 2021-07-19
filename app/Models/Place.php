<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Place extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    protected $searchable = [
       
        'columns' => [
            'name' => 10,
            'phone' => 10,
            'location' => 10,
            'created_at' => 5,
            'updated_At' => 2,
            

        ]
        
    ];
}
