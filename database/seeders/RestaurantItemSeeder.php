<?php

namespace Database\Seeders;

use App\Models\RestaurantItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
        RestaurantItem::factory()->count(10)->create();
        }catch(\Exception $e)
        {
            echo "insertion done";
        }
    }
}
