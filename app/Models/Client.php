<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Nicolaslopezj\Searchable\SearchableTrait;



class Client extends Model
{
    use HasFactory, Sortable, SoftDeletes;
    use SearchableTrait;
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function accounts()
    {
        return $this->hasMany(CXC::class);
    }

    public $sortable = [
        'id',
        'name',
        'phone',
        'debt',
        'rnc',
        'created_at',
        'updated_at'
    ];
    protected $searchable = [
       
        'columns' => [
            'name' => 10,
            'id' => 10,
            'phone' => 10,
            'debt' => 2,
            'created_at' => 5,
            'updated_At' => 2,
        ]
    ];
}
