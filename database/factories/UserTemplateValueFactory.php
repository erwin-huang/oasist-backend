<?php

namespace Database\Factories;

use App\Models\TemplateValue;
use App\Models\UserTemplateSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserTemplateValue>
 */
class UserTemplateValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'template_value_id' => TemplateValue::factory(),
            'user_template_section_id' => UserTemplateSection::factory(),
            'value' => fake()->words(rand(1, 2), true),
        ];
    }
}
