<?php

namespace Database\Seeders;

use App\Models\Animator;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class AnimatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $animator = Animator::factory()->create();

        User::factory()->create([
            'name' => 'Julien Bücher',
            'email' => 'julien.bucher@couleur3.ch',
            'password' => Hash::make('animator'),
            'roleable_id' => $animator->id,
            'roleable_type' => get_class($animator),
        ]);
    }
}
