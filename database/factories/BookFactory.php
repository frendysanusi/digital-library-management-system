<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'category' => $this->faker->name(),
            'description' => $this->faker->text(),
            'stock' => $this->faker->numberBetween(1, 100),
            'book_file' => $this->faker->filePath(),
            'cover_image' => $this->faker->imageUrl(200, 300, 'books'),
        ];
    }
}
