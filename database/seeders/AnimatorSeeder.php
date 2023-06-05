<?php

namespace Database\Seeders;

use App\Models\Animator;
use Illuminate\Database\Seeder;

class AnimatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Animator::factory()->hasUser()->create();
    }
}
