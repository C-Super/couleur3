<?php

namespace Database\Factories;

use App\Enums\InteractionType;
use App\Models\Animator;
use App\Models\CallToAction;
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

        switch ($randomType) {
            case 'mcq':
                $typeable = QuestionChoice::factory()->count(4)->create();
                break;
            case 'survey':
                $typeable = QuestionChoice::factory()->count(4)->create();
                break;
            case 'cta':
                $typeable = CallToAction::factory()->create();
                break;
            case 'quick_click':
                $typeable = CallToAction::factory()->create();
                break;
            case 'text':
            case 'audio':
            case 'video':
            case 'picture':
            default:
                $typeable = null;
        }

        return [
            'title' => $this->faker->sentence(2, 5),
            'type' => $randomType,
            'animator_id' => Animator::factory(),
            'reward_id' => Reward::factory(),
            'winners_count' => $this->faker->numberBetween(1, 20),
            'ended_at' => $this->faker->dateTimeBetween('now', '+10 minutes'),
            'click_to_action' => $typeable,
        ];
    }
}
