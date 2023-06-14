<?php

namespace Database\Factories;

use App\Models\Auditor;
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
            'auditor_id' => Auditor::factory()->hasUser()->create(),
        ];
    }

    // Answer::factory()->count(10)->for(Interaction::factory()->state(['type' => InteractionType::QUICK_CLICK]))->create();
    // Answer::factory()->count(10)->for(Interaction::factory()->state(['type' => InteractionType::CTA]))->for(CallToAction::factory(), 'replyable')->create();

    /**
     *  $interaction = Interaction::factory()->state(['type' => InteractionType::MCQ])->hasQuestionChoices(4)->create();
     * Answer::factory()->count(10)->for($interaction)->for($interaction->questionChoices()->get()->random(), 'replyable')->create();
     */
}
