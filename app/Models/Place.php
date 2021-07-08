<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

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
}
