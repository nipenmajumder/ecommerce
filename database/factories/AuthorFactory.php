<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
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
            'slug' => \Str::slug($name),
            'avatar' => str_replace('public/', '', fake()->image('public/images/author', 640, 480, null, true)),
            'email' => fake()->unique()->freeEmail(),
            'birthday' => fake()->date(),
            'death_day' => fake()->date(),
            'status' => fake()->numberBetween(1, 2),
        ];
    }
}
