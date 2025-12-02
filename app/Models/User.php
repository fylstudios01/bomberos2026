<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'dni',
        'phone',
        'address',
        'birthdate',
        'legajo_number',
        'ingreso_date',
        'hierarchy_id',
        'enabled',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate' => 'date',
        'ingreso_date' => 'date',
    ];

    /**
     * Relationship: hierarchy
     */
    public function hierarchy()
    {
        return $this->belongsTo(\App\Models\Hierarchy::class, 'hierarchy_id');
    }

    /**
     * Relationship: posts (si existe)
     */
    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class, 'user_id');
    }
}
