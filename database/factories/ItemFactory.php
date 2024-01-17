<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    protected $model = Item::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $foodNames = [
            'Cheese Pizza', 'Hamburger', 'Cheeseburger', 'Bacon Burger', 'Bacon Cheeseburger',
            'Little Hamburger', 'Little Cheeseburger', 'Little Bacon Burger', 'Little Bacon Cheeseburger',
            'Veggie Sandwich', 'Cheese Veggie Sandwich', 'Grilled Cheese',
            'Cheese Dog', 'Bacon Dog', 'Bacon Cheese Dog', 'Pasta'
        ];
        return [
            "uuid" => Str::uuid(),
            "name" => $this->faker->unique()->randomElement($foodNames)
        ];
    }
}
