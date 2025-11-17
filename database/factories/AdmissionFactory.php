<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admission>
 */
class AdmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['pending', 'reviewing', 'approved', 'rejected', 'enrolled'];
        $levels = ['beginner', 'n5', 'n4', 'n3', 'n2', 'n1'];

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'date_of_birth' => fake()->date('Y-m-d', '-18 years'),
            'nationality' => fake()->country(),
            'address' => fake()->address(),
            'education_level' => fake()->randomElement(['High School', 'Bachelor', 'Master', 'PhD']),
            'japanese_level' => fake()->randomElement($levels),
            'motivation' => fake()->paragraphs(2, true),
            'status' => fake()->randomElement($statuses),
            'submitted_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
