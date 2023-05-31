<?php

namespace Database\Factories;

use App\Models\Interaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionChoice>
 */
class QuestionChoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //get all interaction and get random id
        $interaction = Interaction::all()->random();
        return [
            'value' => $this->faker->sentence,
            'is_correct_answer' => $this->faker->boolean,
            'interaction_id' => $interaction->id,
        ];
    }
}
