<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        $fakeTitle = fake()->word();

        return [
            'name' => $fakeTitle,
            'slug' => fake()->slug(3),
            'short_description' => fake()->text(),
            'long_description' => fake()->text(),
            'price' => fake()->numberBetween(99, 999),
            'sku' => fake()->word(),
            'thumbnail' => fake()->imageUrl(640, 480, $fakeTitle, true, $fakeTitle),
            'brand_id' => rand(1, 100),
        ];
    }
}
