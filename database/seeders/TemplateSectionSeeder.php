<?php

namespace Database\Seeders;

use App\Models\TemplateSection;
use Illuminate\Database\Seeder;

class TemplateSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TemplateSection::factory()->count(3)->create();
    }
}
