<?php

namespace Database\Factories;

use App\Enums\InteractionType;
use App\Models\AnswerText;
use App\Models\Auditor;
use App\Models\Interaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'auditor_id' => Auditor::factory(),
        ];
    }
}
