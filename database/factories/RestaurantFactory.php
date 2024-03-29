<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "uuid" => Str::uuid(),
            "name" => $this->faker->city . "_restaurant",
            "cuisine_type" => $this->faker->randomElement(["American","Chinese","Arabic","Greek"]),
            "address" => $this->faker->address,
            "email" => $this->faker->unique()->safeEmail,
            "phone" => $this->faker->unique()->phoneNumber,
        ];
    }
}
