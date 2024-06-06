<?php

namespace Database\Factories;

use App\Models\TemplateSection;
use App\Models\UserTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserTemplateSection>
 */
class UserTemplateSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'template_section_id' =>  TemplateSection::factory(),
            'user_template_id' => UserTemplate::factory(),
            'order' => 1,
        ];
    }
}
