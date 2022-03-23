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
        $categories = ['Makanan', 'Pakaian', 'Peralatan Dapur', 'Perkakas Rumah', 'Gadget'];
        foreach ($categories as $key => $value) {
            Category::create([
                'name' => $value
            ]);   
        }
    }
}
