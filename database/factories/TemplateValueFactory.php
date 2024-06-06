<?php

namespace Database\Factories;

use App\Models\TemplateSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TemplateValue>
 */
class TemplateValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(rand(1,2), true);

        return [
            'template_section_id' => TemplateSection::factory(),
            'name' => $name,
            'code' => strtolower(str_replace(' ', '_', $name)),
            'type' => 'text',
            'value' => fake()->words(rand(1,2), true),
        ];
    }
}
