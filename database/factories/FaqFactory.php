<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['general', 'courses', 'visa', 'admission', 'fees'];

        return [
            'question' => fake()->sentence().'?',
            'answer' => fake()->paragraphs(2, true),
            'category' => fake()->randomElement($categories),
            'is_published' => fake()->boolean(90),
            'order' => fake()->numberBetween(0, 100),
            'views' => fake()->numberBetween(0, 1000),
        ];
    }
}
