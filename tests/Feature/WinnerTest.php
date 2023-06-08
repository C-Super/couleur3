<?php

use App\Events\NewWinnerGenerated;
use App\Events\WinnerSentResult;
use App\Events\WinnersListGenerated;
use App\Models\Animator;
use App\Models\Answer;
use App\Models\Auditor;
use App\Models\Interaction;
use App\Models\QuestionChoice;
use App\Models\Reward;
use App\Models\User;
use App\Models\Winner;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\postJson;

uses(DatabaseTransactions::class);

it('generates random winners list successfully', function () {
    Event::fake([WinnersListGenerated::class]);

    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);

    $reward = Reward::factory()->create();

    $interaction = Interaction::factory(
        [
            'animator_id' => $animator->id,
            'type' => 'text',
        ]
    )->create();

    $auditors = Auditor::factory()->count(5)->create();

    foreach ($auditors as $auditor) {
        Answer::factory()->create([
            'interaction_id' => $interaction->id,
            'auditor_id' => $auditor->id,
        ]);
    }

    $this->actingAs($user);

    // Send request
    $response = postJson('/interactions/winner/random', [
        'interaction_id' => $interaction->id,
        'winners_count' => 3,
    ]);

    // Assert response
    $response->assertStatus(200);
    $response->assertJsonStructure(['auditor_ids']);
    $this->assertCount(3, $response['auditor_ids']);

    // Assert database winners with interaction_id
    $this->assertCount(3, Winner::where('interaction_id', $interaction->id)->get());

    // Assert event
    Event::assertDispatched(WinnersListGenerated::class);
});

it('replaces a winner successfully', function () {
    Event::fake([NewWinnerGenerated::class]);

    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);

    $reward = Reward::factory()->create();

    $interaction = Interaction::factory(
        [
            'animator_id' => $animator->id,
            'type' => 'text',
        ]
    )->create();

    $auditors = Auditor::factory()->count(5)->create();

    foreach ($auditors as $auditor) {
        Answer::factory()->create([
            'interaction_id' => $interaction->id,
            'auditor_id' => $auditor->id,
        ]);
    }

    // Create initial winners
    $winners = array_slice($auditors->toArray(), 0, 3);
    foreach ($winners as $winner) {
        Winner::factory()->create([
            'interaction_id' => $interaction->id,
            'auditor_id' => $winner['id'],
        ]);
    }

    $this->actingAs($user);

    // Get first winner to replace
    $winnerToReplace = $winners[0];

    // Send request to replace the first winner
    $response = postJson('/interactions/winner/replace', [
        'interaction_id' => $interaction->id,
        'auditor_id' => $winnerToReplace['id'],
    ]);

    // Assert response
    $response->assertStatus(200);
    $response->assertJsonStructure(['new_auditor_id']);
    $newAuditorId = $response['new_auditor_id'];
    $this->assertNotEquals($winnerToReplace['id'], $newAuditorId);

    // Assert database winners with interaction_id
    $winnersInDb = Winner::where('interaction_id', $interaction->id)->pluck('auditor_id')->toArray();
    $this->assertCount(3, $winnersInDb);
    $this->assertNotContains($winnerToReplace['id'], $winnersInDb);
    $this->assertContains($newAuditorId, $winnersInDb);

    // Assert event
    Event::assertDispatched(NewWinnerGenerated::class);
});

it('stores winners successfully', function () {
    Event::fake([WinnerSentResult::class]);

    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);

    $reward = Reward::factory()->create();

    $interaction = Interaction::factory(
        [
            'animator_id' => $animator->id,
            'type' => 'text',
        ]
    )->create();

    $auditors = Auditor::factory()->count(5)->create();

    foreach ($auditors as $auditor) {
        Answer::factory()->create([
            'interaction_id' => $interaction->id,
            'auditor_id' => $auditor->id,
        ]);
    }

    $this->actingAs($user);

    // Get first 3 auditors to be winners
    $winners = $auditors->take(3)->pluck('id')->toArray();

    // Send request to store the winners
    $response = postJson('/interactions/winner/confirm', [
        'interaction_id' => $interaction->id,
        'auditor_ids' => $winners,
    ]);

    // Assert response
    $response->assertStatus(200);
    $response->assertJson(['message' => 'Winners stored successfully.']);

    // Assert database winners with interaction_id
    $winnersInDb = Winner::where('interaction_id', $interaction->id)->pluck('auditor_id')->toArray();
    $this->assertCount(3, $winnersInDb);
    $this->assertEquals(sort($winners), sort($winnersInDb));

    // Assert event for each winner
    foreach ($winners as $winnerId) {
        Event::assertDispatched(WinnerSentResult::class, function ($event) use ($winnerId) {
            return $event->auditorId === $winnerId;
        });
    }
});

it('stores winners for mcq successfully', function () {
    Event::fake([WinnerSentResult::class]);

    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);

    $reward = Reward::factory()->create();

    $interaction = Interaction::factory(
        [
            'animator_id' => $animator->id,
            'type' => 'mcq',
        ]
    )->create();

    $questionChoice = QuestionChoice::factory()->create(['interaction_id' => $interaction->id]);

    $auditors = Auditor::factory()->count(5)->create();

    foreach ($auditors as $auditor) {
        Answer::factory()->create([
            'interaction_id' => $interaction->id,
            'auditor_id' => $auditor->id,
            'replyable_id' => $questionChoice->id,
            'replyable_type' => get_class($questionChoice),
        ]);
    }

    $this->actingAs($user);

    // Get first 3 auditors to be winners
    $winners = $auditors->take(3)->pluck('id')->toArray();

    // Send request to store the winners
    $response = postJson('/interactions/winner/confirm', [
        'interaction_id' => $interaction->id,
        'auditor_ids' => $winners,
    ]);

    // Assert response
    $response->assertStatus(200);
    $response->assertJson(['message' => 'Winners stored successfully.']);

    // Assert database winners with interaction_id
    $winnersInDb = Winner::where('interaction_id', $interaction->id)->pluck('auditor_id')->toArray();
    $this->assertCount(3, $winnersInDb);
    $this->assertEquals(sort($winners), sort($winnersInDb));

    // Assert event for each winner
    foreach ($winners as $winnerId) {
        Event::assertDispatched(WinnerSentResult::class, function ($event) use ($winnerId) {
            return $event->auditorId === $winnerId;
        });
    }
});

it('cannot random generate winners for mcq', function () {

    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);

    $reward = Reward::factory()->create();

    $interaction = Interaction::factory(
        [
            'animator_id' => $animator->id,
            'type' => 'mcq',
        ]
    )->create();

    $questionChoice = QuestionChoice::factory()->create(['interaction_id' => $interaction->id]);

    $auditors = Auditor::factory()->count(5)->create();

    foreach ($auditors as $auditor) {
        Answer::factory()->create([
            'interaction_id' => $interaction->id,
            'auditor_id' => $auditor->id,
            'replyable_id' => $questionChoice->id,
            'replyable_type' => get_class($questionChoice),
        ]);
    }

    $this->actingAs($user);

    // Get first 3 auditors to be winners
    $winners = $auditors->take(3)->pluck('id')->toArray();

    // Send request to store the winners
    $response = postJson('/interactions/winner/random', [
        'interaction_id' => $interaction->id,
        'winners_count' => 3,
    ]);

    // Assert response
    $response->assertStatus(400);
});

it('generates fastest winners list successfully', function () {
    Event::fake([WinnersListGenerated::class]);

    $animator = Animator::factory()->create();
    $user = User::factory()->create([
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => Hash::make('animator'),
        'roleable_id' => $animator->id,
        'roleable_type' => get_class($animator),
    ]);

    $reward = Reward::factory()->create();

    $interaction = Interaction::factory(
        [
            'animator_id' => $animator->id,
            'type' => 'text',
        ]
    )->create();

    $auditors = Auditor::factory()->count(5)->create();

    foreach ($auditors as $auditor) {
        Answer::factory()->create([
            'interaction_id' => $interaction->id,
            'auditor_id' => $auditor->id,
        ]);
    }

    $this->actingAs($user);

    // Send request
    $response = postJson('/interactions/winner/fastest', [
        'interaction_id' => $interaction->id,
        'winners_count' => 3,
    ]);

    // Assert response
    $response->assertStatus(200);
    $response->assertJsonStructure(['auditor_ids']);
    $this->assertCount(3, $response['auditor_ids']);

    // Assert database winners with interaction_id
    $this->assertCount(3, Winner::where('interaction_id', $interaction->id)->get());

    // Assert event
    Event::assertDispatched(WinnersListGenerated::class);
});
