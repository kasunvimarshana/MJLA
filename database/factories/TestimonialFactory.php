<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'position' => fake()->jobTitle(),
            'company' => fake()->optional()->company(),
            'content' => fake()->paragraph(4),
            'rating' => fake()->numberBetween(4, 5),
            'course' => fake()->optional()->randomElement(['N5 Course', 'N4 Course', 'N3 Course', 'Business Japanese']),
            'is_published' => fake()->boolean(80),
            'is_featured' => fake()->boolean(20),
            'order' => fake()->numberBetween(0, 100),
        ];
    }
}
