<?php

namespace Database\Seeders;

use App\Models\Auditor;
use Illuminate\Database\Seeder;

class AuditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Auditor::factory()->hasUser()->create();
    }
}
