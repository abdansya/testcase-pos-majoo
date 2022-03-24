<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Paket Hemat', 'Paket Premium', 'Paket Ultimate', 'Paket Super'];
        foreach ($categories as $key => $value) {
            Category::create([
                'name' => $value
            ]);   
        }
    }
}
