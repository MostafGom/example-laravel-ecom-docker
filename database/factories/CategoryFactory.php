<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakeWord = fake()->word();

        return [
            'name' => $fakeWord,
            'slug' => fake()->slug(3),
            'description' => fake()->text(),
            'meta_title' => fake()->text(),
            'meta_keyword' => fake()->text(),
            'meta_description' => fake()->text(),
            'image_id' => rand(1, 100),
            'is_active' => fake()->randomElement([1, 0]),
        ];
    }
}
