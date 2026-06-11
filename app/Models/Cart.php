<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'food_item_id',
        'quantity',
        'price',
    ];

    public function foodItem()
    {
        return $this->belongsTo(FoodItem::class);
    }
}