<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LanguageProgram>
 */
class LanguageProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $levels = ['all', 'beginner', 'intermediate', 'advanced'];
        
        return [
            'name' => fake()->words(3, true) . ' Program',
            'description' => fake()->paragraphs(3, true),
            'level' => fake()->randomElement($levels),
            'curriculum' => fake()->paragraphs(4, true),
            'duration_months' => fake()->randomElement([3, 6, 12, 24]),
            'fee' => fake()->randomFloat(2, 100000, 1000000),
            'schedule' => fake()->randomElement(['Weekdays', 'Weekends', 'Evening', 'Flexible']),
            'is_active' => fake()->boolean(85),
            'is_featured' => fake()->boolean(25),
            'order' => fake()->numberBetween(0, 100),
        ];
    }
}
