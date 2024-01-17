<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        "uuid","name","cuisine_type","address","email","phone"
    ];
    protected $cast = [
        "uuid" => "string",
        "name" => "string",
        "cuisine_type" => "string",
        "address" => "string",
        "email" => "string",
        "phone" => "string",
    ];
    protected $append = [
        "average_rating"
    ];
    public function getAverageRatingAttribute() : float{
        $ratings = [];
        foreach($this->ratings as $rating)
            $ratings[] = $rating->rate;
        $c = count($ratings);
        if($c)
        return array_sum($ratings)/$c;
        return -1;
    }
    public function menu() : object{
        return $this->belongsToMany(Item::class,"restaurant_items")->withPivot(["id","price"]);
    }
    public function ratings() : object{
        return $this->hasMany(Rating::class);
    }
    public function orders() : object {
        return $this->hasMany(Order::class);
    }
}
