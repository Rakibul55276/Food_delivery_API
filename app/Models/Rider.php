<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
  protected $fillable = [
    'user_id',
    'vehicle_type',
    'vehicle_number',
    'license_number',
    'is_available',
    'latitude',
    'longitude',
    'fcm_token',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'rider_id');
    }
}