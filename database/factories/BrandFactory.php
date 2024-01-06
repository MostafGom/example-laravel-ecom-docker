<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakeCompany = fake()->company();
        return [
            'name' => $fakeCompany,
            'slug' => Str::slug($fakeCompany),
            'image_id' => rand(1, 100),
            'is_active' => fake()->randomElement([1, 0]),
        ];
    }
}
