<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fiscal extends Model
{
    use HasFactory, SoftDeletes;

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
