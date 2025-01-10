<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        $name =  fake()->words(3, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(15),
            'image' => fake()->imageUrl(600, 600),
            'price' => fake()->randomFloat(1, 1, 499),
            'compare_price' => fake()->randomFloat(1, 500, 999),
            'category_id' => Category::all()->random()->id,
            'store_id' => Store::all()->random()->id,
            'featured' => rand(0, 1),
        ];
    }
}
