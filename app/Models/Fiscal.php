<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Fiscal extends Model
{
    use HasFactory, SoftDeletes, SearchableTrait;

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    protected $searchable = [
       
        'columns' => [
            'fiscals.ncf' => 10,
            'fiscals.id' => 10,
            'fiscals.type' => 10,
            'clients.name' => 10,
            

        ]
        ,
        'joins' => [
            'invoices' => ['fiscals.id','invoices.fiscal_id'],
            'clients' => ['clients.id','invoices.client_id'],
        ],
    ];
}
