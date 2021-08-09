<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;


//Related to buys view
class Outcome extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;
    protected $searchable = [
       
        'columns' => [
            'users.name' => 10,
            'places.name' => 10,
            'providers.name' => 10,
            'outcomes.amount' => 10,
            'outcomes.date' => 10,
            

        ]
        ,
        'joins' => [
            'users' => ['users.id','outcomes.user_id'],
            'places' => ['places.id','outcomes.place_id'],
            'providers' => ['providers.id','outcomes.provider_id'],
        ],
    ];

    public function user()
    {
       return $this->belongsTo(User::class);
    }
    public function place()
    {
        return $this->belongsTo(Place::class);
    }
    public function provider()
    {
       return $this->belongsTo(Provider::class);
    }
    public function client()
    {
       return $this->belongsTo(Client::class);
    }
}
