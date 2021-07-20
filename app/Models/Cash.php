<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Cash extends Model
{
    use HasFactory, SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function incomes()
    {
        return $this->hasMany(Income::class)->where('date','=',date('Y-m-d'));
    }
    public function allIncomes()
    {
        return $this->hasMany(Income::class);
    }
}
