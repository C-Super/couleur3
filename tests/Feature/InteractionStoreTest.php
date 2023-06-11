<?php

use App\Enums\InteractionType;
use App\Models\Animator;
use App\Models\CallToAction;
use App\Models\Interaction;
use App\Models\Reward;
use App\Models\User;
use Carbon\Carbon;
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
        'type' => InteractionType::MCQ,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
        'question_choice_data' => [
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

    $response->assertStatus(200);
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
        'type' => InteractionType::SURVEY,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
        'question_choice_data' => [
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

    $response->assertStatus(200);
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
    $reward = Reward::factory()->create();

    $this->actingAs($user);

    $response = postJson('/interactions/audio', [
        'title' => 'Test Interaction',
        'type' => InteractionType::AUDIO,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
    ]);

    $response->assertStatus(200);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();
});

it('can store video interactions', function () {
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

    $response = postJson('/interactions/video', [
        'title' => 'Test Interaction',
        'type' => InteractionType::VIDEO,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
    ]);

    $response->assertStatus(200);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();
});

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
        'type' => InteractionType::PICTURE,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
    ]);

    $response->assertStatus(200);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();
});

it('can store text interactions', function () {
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

    $response = postJson('/interactions/text', [
        'title' => 'Test Interaction',
        'type' => InteractionType::TEXT,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
    ]);

    $response->assertStatus(200);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();
});

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
        'type' => InteractionType::CTA,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
        'call_to_action_data' => [
            [
                'description' => 'Description 1',
                'link' => 'https://example.com',
                'button_text' => 'Button Text 1',
            ],

        ],

    ]);

    $response->assertStatus(200);
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
    $reward = Reward::factory()->create();
    $cta = CallToAction::factory()->create();

    $this->actingAs($user);

    $response = postJson('/interactions/quick_click', [
        'title' => 'Test Interaction',
        'type' => InteractionType::QUICK_CLICK,
        'call_to_action_id' => $cta->id,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
        'call_to_action_data' => [
            [
                'description' => 'Description 1',
                'link' => 'https://example.com',
                'button_text' => 'Button Text 1',
            ],

        ],
    ]);

    $response->assertStatus(200);
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
    $reward = Reward::factory()->create();
    $cta = CallToAction::factory()->create();
    $endedAt = Carbon::now()->addMilliseconds(1000)->format('Y-m-d H:i:s');

    $this->actingAs($user);

    $response = postJson('/interactions/quick_click', [
        'title' => 'Test Interaction',
        'type' => InteractionType::QUICK_CLICK,
        'call_to_action_id' => $cta->id,
        'ended_at' => $endedAt,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'call_to_action_data' => [
            [
                'description' => 'Description 1',
                'link' => 'https://example.com',
                'button_text' => 'Button Text 1',
            ],

        ],
    ]);
    $response->assertStatus(200);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();

    sleep(1);

    $response = postJson('/interactions', [
        'title' => 'Test Interaction 2',
        'type' => InteractionType::QUICK_CLICK,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
    ]);

    $response->assertStatus(200);
    expect(Interaction::where('title', 'Test Interaction 2')->exists())->toBeTrue();
});

it('cannot store cta interactions with invalid cta id', function () {
    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);
    $reward = Reward::factory()->create();
    $cta = CallToAction::factory()->create();

    $this->actingAs($user);

    $response = postJson('/interactions', [
        'title' => 'Test Interaction',
        'type' => InteractionType::CTA,
        'call_to_action_id' => ($cta->id) + 1,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
    ]);

    $response->assertStatus(422);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeFalse();
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
    $reward = Reward::factory()->create();
    $cta = CallToAction::factory()->create();

    $this->actingAs($user);

    $response = postJson('/interactions/mcq', [
        'title' => 'Test Interaction',
        'type' => InteractionType::MCQ,
        'call_to_action_id' => ($cta->id) + 1,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
        'question_choice_data' => [
            [
                'is_correct_answer' => false,
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
    $reward = Reward::factory()->create();
    $cta = CallToAction::factory()->create();

    $this->actingAs($user);

    $response = postJson('/interactions/mcq', [
        'title' => 'Test Interaction',
        'type' => InteractionType::MCQ,
        'call_to_action_id' => ($cta->id) + 1,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
        'question_choice_data' => [
            [
                'is_correct_answer' => false,
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

it('cannot store an interactions with invalid ended at', function () {
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
        'type' => InteractionType::MCQ,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => '2020-01-01 00:00:00',
    ]);

    $response->assertStatus(422);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeFalse();
});

it('cannot store random name interactions', function () {
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

    $response = postJson('/interactions', [
        'title' => 'Test Interaction',
        'type' => 'sdahgsjhdg',
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
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

    $response = postJson('/interactions/text', [
        'title' => 'Test Interaction',
        'type' => InteractionType::TEXT,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
    ]);
    $response->assertStatus(200);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeTrue();

    $response = postJson('/interactions/mcq', [
        'title' => 'Test Interaction 2',
        'type' => InteractionType::MCQ,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,
        'ended_at' => Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s'),
        'call_to_action_data' => [
            [
                'description' => 'Description 1',
                'link' => 'https://example.com',
                'button_text' => 'Button Text 1',
            ],

        ],
    ]);

    $response->assertStatus(422);
    expect(Interaction::where('title', 'Test Interaction 2')->exists())->toBeFalse();
});

it('cannot store an interaction with no ended_at', function () {
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

    $response = postJson('/interactions/text', [
        'title' => 'Test Interaction',
        'type' => InteractionType::TEXT,
        'animator_id' => $animator->id,
        'reward_id' => $reward->id,
        'winners_count' => 10,

    ]);
    $response->assertStatus(422);
    expect(Interaction::where('title', 'Test Interaction')->exists())->toBeFalse();
});
