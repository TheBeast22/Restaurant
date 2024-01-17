<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id","restaurant_id","rate"
    ];
    protected $cast = [
        "rate" => "integer"
    ];

    public function restaurant() : object {
        return $this->belongsTo(Restaurant::class);
    }
    public function user() : object {
        return $this->belognsTo(User::class);
    }
}
