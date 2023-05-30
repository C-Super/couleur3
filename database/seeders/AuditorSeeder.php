<?php

namespace Database\Seeders;

use App\Models\Auditor;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $auditor = Auditor::factory()->create([
                'phone' => fake()->phoneNumber
            ]);

            User::factory()->create([
                'name' => fake()->name,
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('auditor'),
                'roleable_id' => $auditor->id,
                'roleable_type' => get_class($auditor),
            ]);
        }
    }
}
