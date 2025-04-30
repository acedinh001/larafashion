<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
        ]);


        Storage::deleteDirectory('public');

        // Create parent categories
        Category::factory(5)->create()->each(function ($category) {
            // Create subcategories
            Category::factory(rand(2, 4))->create([
                'parent_id' => $category->id
            ])->each(function ($subcategory) {
                // Create products for each subcategory
                Product::factory(rand(5, 10))->create([
                    'category_id' => $subcategory->id
                ]);
            });
        });
    }
}
