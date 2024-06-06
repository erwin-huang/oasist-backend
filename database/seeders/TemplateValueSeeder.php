<?php

namespace Database\Seeders;

use App\Models\TemplateValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TemplateValue::factory()->count(3)->create();
    }
}
