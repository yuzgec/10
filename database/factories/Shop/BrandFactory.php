<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'tr' => [
                'name' => $name = $this->faker->company(),
                'desc' => $this->faker->paragraph(),
                'seoTitle' => $this->faker->sentence(),
                'seoDesc' => $this->faker->sentence(),
                'seoKey' => $this->faker->words(3, true)
            ],
            'en' => [
                'name' => $name,
                'desc' => $this->faker->paragraph(),
                'seoTitle' => $this->faker->sentence(),
                'seoDesc' => $this->faker->sentence(),
                'seoKey' => $this->faker->words(3, true)
            ],
            'status' => $this->faker->boolean(80),
            'featured' => $this->faker->boolean(20)
        ];
    }
} 