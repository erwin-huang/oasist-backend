<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Template>
 */
class TemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(2, true);

        return [
            'cover_url' => fake()->imageUrl(),
            'name' => $name,
            'code' => strtolower(str_replace(' ', '_', $name)),
            'description' => fake()->sentence(),
        ];
    }
}
