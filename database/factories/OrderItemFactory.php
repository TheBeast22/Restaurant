<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RestaurantItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "restaurant_item_id"=>$this->faker->randomElement(RestaurantItem::pluck("id")),
            "order_id"=>$this->faker->randomElement(Order::pluck("id")),
            "number"=>$this->faker->randomNumber(1)
        ];
    }
}
