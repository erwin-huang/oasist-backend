<?php

namespace Database\Seeders;

use App\Models\Template;
use App\Models\TemplateSection;
use App\Models\TemplateValue;
use App\Models\User;
use App\Models\UserTemplate;
use App\Models\UserTemplateSection;
use App\Models\UserTemplateValue;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory()->count(3)->create();
        $templates = Template::factory()
            ->count(10)
            ->create();

        foreach ($templates as $template) {
            TemplateSection::factory()
                ->count(rand(3, 5))
                ->has(TemplateValue::factory()->count(3))
                ->sequence(fn ($sequence) => ['order' => $sequence->index + 1])
                ->create(['template_id' => $template->id]);
        }

        $userTemplates = UserTemplate::factory()->count(4)
            ->recycle([$users, $templates])
            ->create();

        foreach ($userTemplates as $userTemplate) {
            $templateSections = TemplateSection::where('template_id', $userTemplate->template_id)->get();

            foreach ($templateSections as $templateSection) {
                $userTemplateSection = UserTemplateSection::create([
                    'template_section_id' => $templateSection->id,
                    'user_template_id' => $userTemplate->id,
                    'order' => $templateSection->order, // Assuming 'order' exists in TemplateSection
                ]);

                $templateValues = TemplateValue::where('template_section_id', $templateSection->id)->get();

                foreach ($templateValues as $templateValue) {
                    UserTemplateValue::create([
                        'template_value_id' => $templateValue->id,
                        'user_template_section_id' => $userTemplateSection->id,
                        'value' => $templateValue->value,
                    ]);
                }

            }
        }
    }
}
