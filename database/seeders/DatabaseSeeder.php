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

        Image::factory(100)->create();
        Category::factory(100)->create();
        Brand::factory(100)->create();
        Product::factory(100)->create();
        Product::factory(100)->create();

        $productsIDs = DB::table('products')->pluck('id');
        $categoriesIDs = DB::table('categories')->pluck('id');

        foreach (range(1, 200) as $index) {
            DB::table('category_product')->insert([
                'product_id' => fake()->randomElement($productsIDs),
                'category_id' => fake()->randomElement($categoriesIDs)
            ]);
        }
    }
}
