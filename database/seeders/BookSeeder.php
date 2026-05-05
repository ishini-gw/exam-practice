<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $users = User::all();

        if ($categories->isEmpty() || $users->isEmpty()) {
            return;
        }

        for ($i = 1; $i <= 15; $i++) {

            $title = fake()->sentence(3);

            Book::create([
                'category_id' => $categories->random()->id,
                'title' => $title,
                'author' => fake()->name(),
                'isbn' => fake()->unique()->isbn13(),
                'description' => fake()->paragraph(),
                'published_date' => fake()->date(),
                'pages' => fake()->numberBetween(100, 800),
                'price' => fake()->randomFloat(2, 500, 5000),
                'available_copies' => fake()->numberBetween(0, 20),
                'total_copies' => fake()->numberBetween(10, 30),
                'publisher' => fake()->company(),

                'created_by' => $users->random()->id,
                'updated_by' => null,
                'deleted_by' => null,
            ]);
        }
    }
}
