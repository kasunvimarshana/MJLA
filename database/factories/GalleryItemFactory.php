<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GalleryItem>
 */
class GalleryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['image', 'video'];
        $categories = ['general', 'events', 'classrooms', 'cultural', 'students'];

        return [
            'title' => fake()->sentence(),
            'description' => fake()->optional()->paragraph(),
            'type' => fake()->randomElement($types),
            'category' => fake()->randomElement($categories),
            'is_published' => fake()->boolean(85),
            'is_featured' => fake()->boolean(25),
            'order' => fake()->numberBetween(0, 100),
        ];
    }
}
