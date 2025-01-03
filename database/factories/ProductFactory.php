<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'brand_id' => 1,
            'sku' => 'SKU-' . fake()->randomNumber(4),
            'price' => fake()->randomFloat(2, 10, 1000),
            'stock' => fake()->numberBetween(0, 100),
            'has_variants' => false,
            'status' => true,
            'rank' => fake()->numberBetween(1, 100),
            'featured' => fake()->boolean(),
            'show_on_homepage' => fake()->boolean(),
            'allow_reviews' => true,
            'addGoogle' => true,
            'addComment' => false,
            'deleteContent' => false,
        ];
    }
}
