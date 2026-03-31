<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Smartphones'],
            ['name' => 'Laptops'],
            ['name' => 'Tablets'],
            ['name' => 'Headphones'],
            ['name' => 'Cameras'],
            ['name' => 'Televisions'],
            ['name' => 'Wearables'],
            ['name' => 'Gaming Consoles'],
            ['name' => 'Audio Equipment'],
            ['name' => 'Computer Accessories'],
        ];

        foreach ($categories as &$category) {
            $category['created_at'] = now();    
            $category['updated_at'] = now();
        }

        \DB::table('categories')->insert($categories);
    }
}
