<?php

namespace Database\Seeders;

use App\Models\UserTemplate;
use Illuminate\Database\Seeder;

class UserTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserTemplate::factory()->count(10)->create();
    }
}
