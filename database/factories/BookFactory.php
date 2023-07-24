<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(2),
            'description' => fake()->paragraph(),
            'total' => fake()->numberBetween(20,50),
            'cover' => Storage::url('images/book_general.jpg'),
            'file' => Storage::url('pdf/turban-ch04.pdf'),
            'category_id' => fake()->numberBetween(1,4),
            'user_id' => fake()->numberBetween(1,3)
        ];
    }
}
