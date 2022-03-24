<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i=0; $i < 36; $i++) { 
            Product::create([
                'name' => $faker->sentence(3),
                'description' => $faker->sentence(),
                'price' => rand(100000, 400000),
                'image' => $faker->imageUrl(),
                'category_id' => rand(1,4),
            ]);
        }
    }
}
