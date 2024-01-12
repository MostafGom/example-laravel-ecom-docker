<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    private $numberOfBrands = 20;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admintest@test.com',
            'is_admin' => 1
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'usertest@test.com',
            'is_admin' => 0
        ]);

        Brand::factory($this->numberOfBrands)->create();
        Category::factory(50)->create();
        Image::factory(500)->create();

        $categoriesIDs = DB::table('categories')->pluck('id');
        $imagesIDs = DB::table('images')->pluck('id');
        $imagesSeeded = DB::select('select * from images');

        foreach (range(1, 200) as $index) {
            $fakeTitle = fake()->word();
            $randomImageIndex = rand(1, 499);
            $randomImage = $imagesSeeded[$randomImageIndex];

            Product::factory()->create([
                'name' => $fakeTitle,
                'slug' => fake()->slug(3),
                'short_description' => fake()->text(),
                'long_description' => fake()->text(),
                'price' => fake()->numberBetween(99, 999),
                'sku' => fake()->word(),
                'thumbnail' => json_encode(['id' => $randomImage->id, 'image_path' => $randomImage->image_path]),
                'brand_id' => rand(1, $this->numberOfBrands),
            ]);
        }

        $productsIDs = DB::table('products')->pluck('id');


        foreach (range(1, 500) as $index) {
            DB::table('image_product')->insert([
                'product_id' => fake()->randomElement($productsIDs),
                'image_id' => fake()->randomElement($imagesIDs)
            ]);
        }

        foreach (range(1, 200) as $index) {
            DB::table('category_product')->insert([
                'product_id' => fake()->randomElement($productsIDs),
                'category_id' => fake()->randomElement($categoriesIDs)
            ]);
        }
    }
}
