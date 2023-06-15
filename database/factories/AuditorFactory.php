<?php

namespace Database\Factories;

use App\Models\Auditor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auditor>
 */
class AuditorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone' => $this->faker->phoneNumber,
        ];
    }

    public function withUser(array $userAttributes = [])
    {
        return $this->afterCreating(function (Auditor $auditor) use ($userAttributes) {
            User::create(array_merge([
                'roleable_id' => $auditor->id,
                'roleable_type' => Auditor::class,
            ], $userAttributes));
        });
    }
}
