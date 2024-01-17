<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        "restaurant_item_id","order_id","number"
    ];
    protected $cast = [
        "number" => "integer"
    ];
    public function order() : object{
        return $this->belongsTo(Order::class);
    }
    public function item() : object {
        return $this->belongsTo(RestaurantItem::class);
    }
}
