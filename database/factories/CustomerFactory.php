<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->name(),
            'authorized_person' => fake()->name(),
            'staff_name' => fake()->name(),
            'email1' => fake()->unique()->companyEmail(),
            'email2' => fake()->unique()->email(),
            'phone1' => fake()->phoneNumber(),
            'phone2' => fake()->phoneNumber(),
            'website1'  => 'godijital.net',
            'facebook'  => 'facebook.com/godijital.net',
            'instagram' => 'instagram.com/godijital.net',
            'linkedin'  => 'linkedin.com/godijital.net',
            'tiktok'    => 'tiktok.com/godijital.net',
            'youtube'   => 'youtube.com/godijital.net',
            'created_by' => 1,
            'updated_by' => 1,

        ];
    }
}
