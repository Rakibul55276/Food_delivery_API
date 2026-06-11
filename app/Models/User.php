<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
    ];
    public function restaurants()
{
    return $this->hasMany(Restaurant::class);
}

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function orders()
{
    return $this->hasMany(Order::class);
}

public function addresses()
{
    return $this->hasMany(Address::class);
}

public function rider()
{
    return $this->hasOne(\App\Models\Rider::class);
}
}