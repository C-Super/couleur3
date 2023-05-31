<?php

namespace Database\Factories;

use App\Models\Animator;
use App\Models\Reward;
use App\Models\CallToAction;
use App\Models\QuestionChoice;
use App\Enums\InteractionType;
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

        switch ($randomType) {
            case InteractionType::MCQ:
            case InteractionType::SURVEY:
                $typeable = QuestionChoice::factory()->create();
                break;
            case InteractionType::CTA:
            case InteractionType::QUICK_CLICK:
                $typeable = CallToAction::factory()->create();
                break;
            case InteractionType::TEXT:
            case InteractionType::AUDIO:
            case InteractionType::VIDEO:
            case InteractionType::PICTURE:
            default:
                $typeable = null;
        }

        return [
            'title' => $this->faker->sentence,
            'type' => $randomType,
            'animator_id' => Animator::factory(),
            'reward_id' => Reward::factory(),
            'winners_count' => $this->faker->numberBetween(1, 20),
            'typeable_id' => $typeable ? $typeable->id : null,
            'typeable_type' => $typeable ? get_class($typeable) : null,
        ];
    }
}
