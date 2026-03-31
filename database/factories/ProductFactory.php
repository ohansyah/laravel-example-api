<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brandIds = \App\Models\Brand::pluck('id')->toArray();
        $categoryIds = \App\Models\Category::pluck('id')->toArray();
        
        return [
            'brand_id' => $this->faker->randomElement($brandIds),
            'category_id' => $this->faker->randomElement($categoryIds),
            'name' => $this->faker->word(),
            'barcode' => $this->faker->unique()->ean13(),
            'sku' => $this->faker->unique()->bothify('???-########'),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'views' => 0,
        ];
    }
}
