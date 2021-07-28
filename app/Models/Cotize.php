<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Cotize extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function salor()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
    public function place()
    {
        return $this->belongsTo(Place::class)->withTrashed();
    }
    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }
    protected $searchable = [

        'columns' => [
            'users.name' => 10,
            'clients.name' => 10,
            'places.name' => 10,
            'places.location' => 10,
            'invoices.created_at' => 5,
            'invoices.updated_At' => 2,


        ],
        'joins' => [
            'clients' => ['cotizes.client_id', 'clients.id'],
            'users' => ['cotizes.user_id', 'users.id'],
            'places' => ['cotizes.place_id', 'places.id'],
        ],
    ];
}
