<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "uuid","user_id","restaurant_id","type","status"
    ];
    protected $cast = [
        "uuid" => "string",
        "type" => "string",
        "status" => "string",
    ];
    public function items() : object {
        return $this->belongsToMany(RestaurantItem::class,"order_items")->withPivot("number");
    }
    public function user() : object{
        return $this->belongsTo(User::class);
    }
    public function restaurant(): object{
        return $this->belongsTo(Restaurant::class);
    }
}
