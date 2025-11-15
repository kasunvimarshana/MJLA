<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['general', 'cultural', 'academic', 'student-life'];
        
        return [
            'title' => fake()->sentence(),
            'excerpt' => fake()->paragraph(),
            'content' => fake()->paragraphs(6, true),
            'category' => fake()->randomElement($categories),
            'author_id' => null,
            'is_published' => fake()->boolean(75),
            'is_featured' => fake()->boolean(20),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'views' => fake()->numberBetween(0, 10000),
            'tags' => fake()->words(5),
        ];
    }
}
