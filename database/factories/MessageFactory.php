<?php

namespace Database\Factories;

use App\Models\Auditor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $auditors = Auditor::all()->pluck('id');

        return [
            'content' => $this->faker->sentence(),
            'auditor_id' => $this->faker->randomElement($auditors),
        ];
    }
}
