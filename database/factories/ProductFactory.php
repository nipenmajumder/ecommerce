<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Publication;
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
        $authors = Author::query()->get();
        $publication = Publication::query()->get();
        $name = fake()->name();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'sku' => fake()->unique()->numerify('SKU-##########'),
            'barcode' => fake()->unique()->numerify('##########'),
            'image' => str_replace('public/', '', fake()->image('public/images/product', 640, 480, null, true)),
            'description' => fake()->text(),
            'author_id' => $authors->random()->id,
            'publication_id' => $publication->random()->id,
            'buy_price' => fake()->numberBetween(100, 1000),
            'sell_price' => fake()->numberBetween(1000, 10000),
            'status' => fake()->numberBetween(1, 2)
        ];
    }
}
