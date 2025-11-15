<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VisaService>
 */
class VisaServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['student', 'work', 'tourist', 'dependent'];
        
        return [
            'title' => fake()->words(3, true) . ' Visa Service',
            'description' => fake()->paragraphs(3, true),
            'requirements' => fake()->paragraphs(2, true),
            'process' => fake()->paragraphs(2, true),
            'category' => fake()->randomElement($categories),
            'fee' => fake()->randomFloat(2, 50000, 300000),
            'processing_days' => fake()->numberBetween(7, 90),
            'is_active' => fake()->boolean(85),
            'is_featured' => fake()->boolean(30),
            'order' => fake()->numberBetween(0, 100),
        ];
    }
}
