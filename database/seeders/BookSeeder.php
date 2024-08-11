<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory()->count(20)->create();

        $users = User::all();
        $books = Book::all();

        $books->each(function ($book) use ($users) {
            if (rand(0, 1)) {
                $book->users()->attach(
                    $users->random(3)->pluck('id')->toArray()
                );
            }
        });
    }
}
