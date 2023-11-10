<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'email' => fake()->freeEmail(),
            'phone' => fake()->numerify('01#########'),
            'address' => fake()->address(),
            'description' => fake()->text(),
            'image' => str_replace('public/', '', fake()->image('public/images/publication', 640, 480, null, true)),
            'status' => fake()->numberBetween(1, 2),
        ];
    }
}
