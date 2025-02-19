<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Product;
use App\Models\Shop\Brand;
use App\Enums\ProductTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        
        return [
            'brand_id' => Brand::factory(),
            'type' => ProductTypeEnum::SIMPLE,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'manage_stock' => true,
            'sku' => $this->faker->unique()->ean8,
            'status' => $this->faker->boolean(80),
            'tr' => [
                'name' => $name,
                'short' => $this->faker->sentence(),
                'desc' => $this->faker->paragraphs(3, true),
                'seoTitle' => $this->faker->sentence(),
                'seoDesc' => $this->faker->sentence(),
                'seoKey' => $this->faker->words(3, true)
            ],
            'en' => [
                'name' => $name,
                'short' => $this->faker->sentence(),
                'desc' => $this->faker->paragraphs(3, true),
                'seoTitle' => $this->faker->sentence(),
                'seoDesc' => $this->faker->sentence(),
                'seoKey' => $this->faker->words(3, true)
            ]
        ];
    }

    public function simple(): self
    {
        return $this->state(fn (array $attributes) => [
            'type' => ProductTypeEnum::SIMPLE
        ]);
    }

    public function variable(): self
    {
        return $this->state(fn (array $attributes) => [
            'type' => ProductTypeEnum::VARIABLE
        ]);
    }
} 