<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $levels = ['beginner', 'intermediate', 'advanced'];

        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraphs(3, true),
            'objectives' => fake()->paragraphs(2, true),
            'level' => fake()->randomElement($levels),
            'duration_weeks' => fake()->numberBetween(8, 52),
            'price' => fake()->randomFloat(2, 50000, 500000),
            'max_students' => fake()->numberBetween(10, 30),
            'start_date' => fake()->dateTimeBetween('now', '+3 months'),
            'end_date' => fake()->dateTimeBetween('+4 months', '+12 months'),
            'is_active' => fake()->boolean(80),
            'is_featured' => fake()->boolean(20),
            'order' => fake()->numberBetween(0, 100),
        ];
    }
}
