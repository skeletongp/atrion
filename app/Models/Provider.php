<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Provider extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;
    protected $searchable = [

        'columns' => [
            'name' => 10,
            'id' => 10,
            'meta' => 10,
            'created_at' => 5,
            'updated_At' => 2,
        ],  
        
    ];
    public function days()
    {
        return $this->belongsToMany(Day::class, 'day_provider', 'provider_id','day_id');
    }
}
