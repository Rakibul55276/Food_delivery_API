<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle_type',
        'plate_number',
        'license_no',
        'current_latitude',
        'current_longitude',
        'is_available',
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