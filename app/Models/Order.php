<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Restaurant;
use App\Models\Rider;


class Order extends Model
{
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'rider_id',
        'order_no',
        'subtotal',
        'delivery_fee',
        'discount',
        'tax',
        'total_amount',
        'payment_method',
        'payment_status',
        'order_status',
        'rider_status',
        'delivery_address',
        'latitude',
        'longitude',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

  public function rider()
{
    return $this->belongsTo(Rider::class, 'rider_id');
}
}