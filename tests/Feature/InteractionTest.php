<?php

use App\Models\Interaction;
use App\Models\Animator;
use App\Models\Reward;
use function Pest\Laravel\{postJson, patchJson, deleteJson};

it('can store interactions', function () {
    $animator = Animator::factory()->create();
    $reward = Reward::factory()->create();

    $response = postJson('/interactions', [
        'title' => 'Test Interaction',
        'type' => 'MCQ',
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
    ]);

    $response->assertStatus(201);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();
});

it('can update interactions', function () {
    $interaction = Interaction::factory()->create();
    $newAnimator = Animator::factory()->create();
    $newReward = Reward::factory()->create();

    $response = patchJson("/interactions/{$interaction->id}", [
        'title' => 'Updated Title',
        'type' => 'SURVEY',
        'animator_id' => $newAnimator->id,
        'reward_id' => $newReward->id,
        'winners_count' => 5,
    ]);

    $response->assertStatus(200);
    expect(Interaction::where('title', 'Updated Title')->exists())->toBeTrue();
});

it('can delete interactions', function () {
    $interaction = Interaction::factory()->create();

    $response = deleteJson("/interactions/{$interaction->id}");

    $response->assertStatus(204);
    expect(Interaction::where('id', $interaction->id)->exists())->toBeFalse();
});
