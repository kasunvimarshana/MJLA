<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['news', 'event', 'announcement'];
        $types = ['article', 'event'];
        $type = fake()->randomElement($types);
        
        return [
            'title' => fake()->sentence(),
            'excerpt' => fake()->paragraph(),
            'content' => fake()->paragraphs(5, true),
            'category' => fake()->randomElement($categories),
            'type' => $type,
            'event_date' => $type === 'event' ? fake()->dateTimeBetween('now', '+6 months') : null,
            'event_location' => $type === 'event' ? fake()->address() : null,
            'is_published' => fake()->boolean(75),
            'is_featured' => fake()->boolean(20),
            'author_id' => null,
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
            'views' => fake()->numberBetween(0, 5000),
        ];
    }
}
