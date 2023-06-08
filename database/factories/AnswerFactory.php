<?php

namespace Database\Factories;

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
        $interaction = Interaction::factory()->create(['type' => 'text']);
        $answerText = AnswerText::factory()->create();

        return [
            'interaction_id' => $interaction->id,
            'auditor_id' => Auditor::factory(),
            'replyable_id' => $answerText->id,
            'replyable_type' => AnswerText::class,
        ];
    }
}
