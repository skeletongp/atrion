<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Kyslik\ColumnSortable\Sortable;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SearchableTrait, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /* Columbas que se pueden ordenar */
    public $sortable = [
        'id',
        'name',
        'email',
        'created_at',
        'updated_at'
    ];
    /* Columnas en las que puede buscar */
    protected $searchable = [

        'columns' => [
            'users.name' => 10,
            'users.id' => 10,
            'users.email' => 10,
            'roles.name' => 10,
            'places.name' => 10,
            'users.created_at' => 5,
            'users.updated_At' => 2,
        ],  
        'joins'=>[
            'model_has_roles'=>['model_has_roles.model_id','users.id'],
            'roles'=>['model_has_roles.role_id','roles.id'  ],
            'places'=>['users.place_id','places.id'  ],
        ]
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
