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

        $products = [
            'names' => ['Majoo Pro', 'Majoo Advance', 'Majoo Livestyle', 'Majoo Desktop'],
            'images' => ['standard-repo.png', 'paket-advance.png', 'paket-lifestyle.png', 'paket-desktop.png'],
        ];
        foreach ($products['names'] as $key => $name) {
            Product::create([
                'name' => $name,
                'description' => $faker->sentence($key+30+($key*3)),
                'price' => 2000000 + ($key * 300000),
                'image' => url('images/'.$products['images'][$key]),
                'category_id' => rand(1,4),
            ]);
        }
    }
}
