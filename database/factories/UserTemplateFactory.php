<?php

namespace Database\Factories;

use App\Models\Template;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserTemplate>
 */
class UserTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'template_id' => Template::factory(),
            'user_id' => User::factory(),
            'name' => fake()->words(rand(1, 2), true),
            'is_paid' => rand(0, 1),
            'published_at' => rand(0, 1) ? fake()->dateTimeThisYear('+1 years') : null,
        ];
    }
}
