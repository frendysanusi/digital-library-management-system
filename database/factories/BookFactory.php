<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\BookCategory;

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
        $categoryIds = BookCategory::pluck('id')->toArray();
        $categoryId = $this->faker->randomElement($categoryIds);

        return [
            'title' => $this->faker->name(),
            'category_id' => $categoryId,
            'description' => $this->faker->text(),
            'stock' => $this->faker->numberBetween(1, 20),
            // 'book_file' => $this->faker->filePath(),
            // 'cover_image' => $this->faker->imageUrl(200, 300, 'books'),
        ];
    }
}
