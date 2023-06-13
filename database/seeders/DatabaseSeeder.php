<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AnimatorSeeder::class,
            AuditorSeeder::class,
            MessageSeeder::class,
        ]);

        // Answer::factory()->count(10)->for(Interaction::factory()->state(['type' => 'QUICK_CLICK']))->for(CallToAction::factory(), 'replyable')->create()
    }
}
