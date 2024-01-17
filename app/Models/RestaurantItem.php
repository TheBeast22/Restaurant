<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantItem extends Model
{
    use HasFactory;
    protected $fillable = [
        "uuid","item_id","restaurant_id","price"
    ];
    protected $cast = [
        "uuid" => "string",
        "price" => "float"
    ];
    public function restaurant() : object {
        return $this->belongsTo(Restaurant::class);
    }
    public function item() : object {
        return $this->belongsTo(Item::class);
    }
}
