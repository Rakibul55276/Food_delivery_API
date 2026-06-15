<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiderOrderDecline extends Model
{
    protected $fillable = [
        'order_id',
        'rider_id',
    ];
}