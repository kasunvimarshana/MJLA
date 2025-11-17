<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departments = ['Administration', 'Teaching', 'Student Services', 'Visa Support'];

        return [
            'name' => fake()->name(),
            'position' => fake()->jobTitle(),
            'department' => fake()->randomElement($departments),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'bio' => fake()->paragraphs(3, true),
            'qualifications' => fake()->paragraphs(2, true),
            'specialization' => fake()->words(5, true),
            'is_active' => fake()->boolean(90),
            'is_featured' => fake()->boolean(30),
            'order' => fake()->numberBetween(0, 100),
        ];
    }
}
