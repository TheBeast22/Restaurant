<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        "uuid","name"
    ];
    protected $cast = [
        "uuid" => "string",
        "name" => "string",
    ];
    public function restaurants() : object {
        return $this->belongsToMany(Restaurant::class,"restaurant_items")->withPivot("price");
    }
    public function menu() : object {
        return $this->hasMany(RestaurantItem::class);
    }
}
