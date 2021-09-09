<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Invoice extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function place()
    {
        return $this->belongsTo(Place::class)->withTrashed();
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }
    public function fiscal()
    {
        return $this->belongsTo(Fiscal::class)->withTrashed();
    }
    public function getRouteKeyName()
    {
        return 'number';
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
            'clients' => ['invoices.client_id','clients.id'],
            'users' => ['invoices.user_id','users.id'],
            'places' => ['invoices.place_id','places.id'],
        ],
    ];
}
