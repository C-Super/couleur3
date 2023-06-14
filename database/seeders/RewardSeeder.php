<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rewards = [
            ['name' => 'Casquette', 'description' => 'Une belle casquette de qualité'],
            ['name' => 'Tablier', 'description' => 'Un tablier pour vos activités de cuisine'],
            ['name' => 'Bob', 'description' => 'Un bob stylé pour l\'été'],
            ['name' => 'Linge de bain', 'description' => 'Un linge de bain doux et confortable'],
            ['name' => 'Bonnet', 'description' => 'Un bonnet chaud pour l\'hiver'],
        ];

        foreach ($rewards as $reward) {
            Reward::create($reward);
        }
    }
}
