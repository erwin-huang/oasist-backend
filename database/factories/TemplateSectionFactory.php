<?php

namespace Database\Factories;

use App\Models\Template;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TemplateSection>
 */
class TemplateSectionFactory extends Factory
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
            'template_id' => Template::factory(),
            'name' => $name,
            'code' => strtolower(str_replace(' ', '_', $name)),
            'description' => fake()->sentence(),
            'order' => 1,
        ];
    }
}
