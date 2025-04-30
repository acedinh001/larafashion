<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'sale_price' => $this->faker->optional(0.3)->randomFloat(2, 5, 900),
            'stock' => $this->faker->numberBetween(0, 100),
            'is_active' => $this->faker->boolean(80),
            'featured' => $this->faker->boolean(20),
            'category_id' => Category::factory(),
            'specifications' => [
                'Color' => $this->faker->safeColorName(),
                'Weight' => $this->faker->numberBetween(1, 10) . ' kg',
                'Size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            ],
        ];
    }

}
