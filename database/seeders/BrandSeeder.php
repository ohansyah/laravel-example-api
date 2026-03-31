<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Apple'],
            ['name' => 'Samsung'],
            ['name' => 'Sony'],
            ['name' => 'LG'],
            ['name' => 'Dell'],
            ['name' => 'HP'],
            ['name' => 'Lenovo'],
            ['name' => 'Asus'],
            ['name' => 'Acer'],
            ['name' => 'Microsoft'],
        ];

        foreach ($brands as &$brand) {
            $brand['created_at'] = now();    
            $brand['updated_at'] = now();
        }

        \DB::table('brands')->insert($brands);
    }
}
