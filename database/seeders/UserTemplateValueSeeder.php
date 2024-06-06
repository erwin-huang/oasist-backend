<?php

namespace Database\Seeders;

use App\Models\UserTemplateValue;
use Illuminate\Database\Seeder;

class UserTemplateValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserTemplateValue::factory()->count(10)->create();
    }
}
