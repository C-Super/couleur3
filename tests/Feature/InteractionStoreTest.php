<?php

use App\Models\Animator;
use App\Models\Interaction;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use function Pest\Laravel\postJson;

uses(DatabaseTransactions::class);

it('can store mcq interactions', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);
    $reward = Reward::factory()->create();

    $this->actingAs($user);

    $response = postJson('/interactions/mcq', [
        'title' => 'Test Interaction',
        'duration' => 100,
        'question_choices' => [
            [
                'is_correct_answer' => true,
                'value' => 'Choice 1',
            ],
            [
                'is_correct_answer' => false,
                'value' => 'Choice 2',
            ],
        ],
    ]);

    $response->assertStatus(302);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();
    // Assert that the question_choice were stored correctly
    $interaction = Interaction::where('title', 'Test Interaction')->first();
    expect($interaction->question_choices()->count())->toBe(2);
});

it('can store survey interactions', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);
    $reward = Reward::factory()->create();

    $this->actingAs($user);

    $response = postJson('/interactions/survey', [
        'title' => 'Test Interaction',
        'duration' => 100,
        'question_choices' => [
            [
                'is_correct_answer' => false,
                'value' => 'Choice 1',
            ],
            [
                'is_correct_answer' => false,
                'value' => 'Choice 2',
            ],
        ],
    ]);

    $response->assertStatus(302);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();
    // Assert that the question_choice were stored correctly
    $interaction = Interaction::where('title', 'Test Interaction')->first();
    expect($interaction->question_choices()->count())->toBe(2);
});

it('can store audio interactions', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);

    $this->actingAs($user);

    $response = postJson('/interactions/audio', [
        'title' => 'Test Interaction',
        'duration' => 100,
    ]);

    $response->assertStatus(302);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();
})->skip('Audio interactions are not implemented yet');

it('can store video interactions', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);

    $this->actingAs($user);

    $response = postJson('/interactions/video', [
        'title' => 'Test Interaction',
        'duration' => 100,
    ]);

    $response->assertStatus(302);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();
})->skip('Video interactions are not implemented yet');

it('can store picture interactions', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);
    $reward = Reward::factory()->create();

    $this->actingAs($user);

    $response = postJson('/interactions/picture', [
        'title' => 'Test Interaction',
        'duration' => 100,
    ]);

    $response->assertStatus(302);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();
})->skip('Picture interactions are not implemented yet');

it('can store text interactions', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);

    $this->actingAs($user);

    $response = postJson('/interactions/text', [
        'title' => 'Test Interaction',
        'duration' => 100,
    ]);

    $response->assertStatus(302);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();
})->skip('Text interactions are not implemented yet');

it('can store cta interactions', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);
    $reward = Reward::factory()->create();

    $this->actingAs($user);

    $response = postJson('/interactions/cta', [
        'title' => 'Test Interaction',
        'link' => 'https://google.com',
        'duration' => 300,

    ]);

    $response->assertStatus(302); // Doit être 302 car il y a une redirection après la création du CTA
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();
});

it('can store quick_click interactions', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);

    $this->actingAs($user);

    $response = postJson('/interactions/quick_click', [
        'title' => 'Test Interaction',
        'duration' => 300,
    ]);

    $response->assertStatus(302);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();
});

it('can store an interactions when another interaction is finished', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);

    $this->actingAs($user);

    $response = postJson('/interactions/cta', [
        'title' => 'Test Interaction',
        'duration' => 500,
        'link' => 'https://example.com',
    ]);

    $response->assertStatus(302);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();

    sleep(1);

    $response = postJson('/interactions/cta', [
        'title' => 'Test Interaction 2',
        'duration' => 500,
        'link' => 'https://example.com',
    ]);

    $response->assertStatus(302);
    expect(Interaction::where('title', 'Test Interaction 2')->exists())->toBeTrue();
});

it('cannot store survey or mcq interactions with less than 1 choice', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);

    $this->actingAs($user);

    $response = postJson('/interactions/mcq', [
        'title' => 'Test Interaction',
        'duration' => 100,
        'question_choices' => [
            [
                'is_correct_answer' => true,
                'value' => 'Choice 1',
            ],
        ],
    ]);

    $response->assertStatus(422);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeFalse();
});

it('cannot store survey or mcq interactions with more than 4 choices', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);

    $this->actingAs($user);

    $response = postJson('/interactions/mcq', [
        'title' => 'Test Interaction',
        'duration' => 100,
        'question_choices' => [
            [
                'is_correct_answer' => true,
                'value' => 'Choice 1',
            ],
            [
                'is_correct_answer' => false,
                'value' => 'Choice 2',
            ],
            [
                'is_correct_answer' => false,
                'value' => 'Choice 3',
            ],
            [
                'is_correct_answer' => false,
                'value' => 'Choice 4',
            ],
            [
                'is_correct_answer' => false,
                'value' => 'Choice 5',
            ],
        ],
    ]);

    $response->assertStatus(422);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeFalse();
});

it('cannot store an interactions with no ended at', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);
    $reward = Reward::factory()->create();

    $this->actingAs($user);

    $response = postJson('/interactions/cta', [
        'title' => 'Test Interaction',
        'duration' => 0,
        'link' => 'https://example.com',
    ]);

    $response->assertStatus(422);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeFalse();
});

it('cannot store an interaction with another interaction running', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);
    $reward = Reward::factory()->create();

    $this->actingAs($user);

    $response = postJson('/interactions/cta', [
        'title' => 'Test Interaction',
        'duration' => 500,
        'link' => 'https://example.com',
    ]);
    $response->assertStatus(302);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();

    $response = postJson('/interactions/mcq', [
        'title' => 'Test Interaction 2',
        'duration' => 500,
        'link' => 'https://example.com',
    ]);

    $response->assertStatus(422);
    expect(Interaction::where('title', 'Test Interaction 2')->exists())->toBeFalse();
});
