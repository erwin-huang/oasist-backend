<?php

namespace Database\Seeders;

use App\Models\UserTemplateSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTemplateSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserTemplateSection::factory()->count(10)->create();
    }
}
