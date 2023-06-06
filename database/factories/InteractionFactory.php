<?php

namespace Database\Factories;

use App\Enums\InteractionType;
use App\Models\Animator;
use App\Models\CallToAction;
use App\Models\Interaction;
use App\Models\QuestionChoice;
use App\Models\Reward;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interaction>
 */
class InteractionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomType = $this->faker->randomElement(InteractionType::getValues());

        return [
            'title' => $this->faker->sentence(2, 5),
            'type' => $randomType,
            'animator_id' => Animator::factory(),
            'reward_id' => Reward::factory(),
            'winners_count' => $this->faker->numberBetween(1, 20),
            'ended_at' => $this->faker->dateTimeBetween('now', '+10 minutes'),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Interaction $interaction) {
            switch ($interaction->type) {
                case InteractionType::MCQ->value:
                case InteractionType::SURVEY->value:
                    $interaction->question_choices()->saveMany(QuestionChoice::factory()->count(4)->make());
                    break;
                case InteractionType::CTA->value:
                case InteractionType::QUICK_CLICK->value:
                    $interaction->call_to_action()->save(CallToAction::factory()->make());
                    break;
            }
        });
    }
}
