<?php

use App\Models\Answer;
use App\Models\AnswerText;
use App\Models\Auditor;
use App\Models\Interaction;
use App\Models\Media;
use App\Models\QuestionChoice;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\postJson;

uses(DatabaseTransactions::class);

use App\Events\AnswerQuestionChoiceSubmited;
use App\Events\AnswerSubmitedToAnimator;
use Illuminate\Support\Facades\Event;

it('can store text answer and fires correct event', function () {
    Event::fake([AnswerSubmitedToAnimator::class, AnswerQuestionChoiceSubmited::class]);

    $auditor = Auditor::factory()->create();
    $user = User::factory()->create([
        'name' => 'test',
        'email' => 'testd@example.com',
        'password' => Hash::make('password'),
        'roleable_id' => $auditor->id,
        'roleable_type' => get_class($auditor),
    ]);

    $interaction = Interaction::factory()->create([
        'type' => 'text',
    ]);

    $this->actingAs($user);

    $response = postJson('/answer', [
        'auditor_id' => $auditor->id,
        'interaction_id' => $interaction->id,
        'type' => 'text',
        'replyable_data' => [
            'content' => 'This is a text answer.',
        ],
    ]);

    $response->assertStatus(200);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeTrue();
    expect(AnswerText::where('content', 'This is a text answer.')->exists())->toBeTrue();

    Event::assertDispatched(AnswerSubmitedToAnimator::class, function ($event) use ($auditor) {
        return $event->answer->auditor_id === $auditor->id;
    });

    Event::assertNotDispatched(AnswerQuestionChoiceSubmited::class);
});

it('can store media picture answer', function () {
    $auditor = Auditor::factory()->create();
    $user = User::factory()->create([
        'name' => 'test',
        'email' => 'test2@example.com',
        'password' => Hash::make('password'),
        'roleable_id' => $auditor->id,
        'roleable_type' => get_class($auditor),
    ]);
    $interaction = Interaction::factory()->create([
        'type' => 'picture',
    ]);

    $this->actingAs($user);

    $response = postJson('/answer', [
        'auditor_id' => $auditor->id,
        'interaction_id' => $interaction->id,
        'type' => 'picture',
        'replyable_data' => [
            'path' => 'path/to/media',
            'type' => 'picture',
        ],
    ]);

    $response->assertStatus(200);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeTrue();
    expect(Media::where('path', 'path/to/media')->exists())->toBeTrue();
});

it('can store media audio answer', function () {
    $auditor = Auditor::factory()->create();
    $user = User::factory()->create([
        'name' => 'test',
        'email' => 'test4@example.com',
        'password' => Hash::make('password'),
        'roleable_id' => $auditor->id,
        'roleable_type' => get_class($auditor),
    ]);
    $interaction = Interaction::factory()->create([
        'type' => 'audio',
    ]);

    $this->actingAs($user);

    $response = postJson('/answer', [
        'auditor_id' => $auditor->id,
        'interaction_id' => $interaction->id,
        'type' => 'audio',
        'replyable_data' => [
            'path' => 'path/to/media',
            'type' => 'audio',
        ],
    ]);

    $response->assertStatus(200);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeTrue();
    expect(Media::where('path', 'path/to/media')->exists())->toBeTrue();
});

it('can store media video answer', function () {
    $auditor = Auditor::factory()->create();
    $user = User::factory()->create([
        'name' => 'test',
        'email' => 'test5@example.com',
        'password' => Hash::make('password'),
        'roleable_id' => $auditor->id,
        'roleable_type' => get_class($auditor),
    ]);
    $interaction = Interaction::factory()->create([
        'type' => 'video',
    ]);

    $this->actingAs($user);

    $response = postJson('/answer', [
        'auditor_id' => $auditor->id,
        'interaction_id' => $interaction->id,
        'type' => 'video',
        'replyable_data' => [
            'path' => 'path/to/media',
            'type' => 'video',
        ],
    ]);

    $response->assertStatus(200);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeTrue();
    expect(Media::where('path', 'path/to/media')->exists())->toBeTrue();
});

it('can store mcq answer', function () {
    $auditor = Auditor::factory()->create();
    $user = User::factory()->create([
        'name' => 'test',
        'email' => 'test1@example.com',
        'password' => Hash::make('password'),
        'roleable_id' => $auditor->id,
        'roleable_type' => get_class($auditor),
    ]);
    $interaction = Interaction::factory()->create([
        'type' => 'mcq',
    ]);
    $questionChoice = QuestionChoice::factory()->create(['interaction_id' => $interaction->id]);

    $this->actingAs($user);

    $response = postJson('/answer', [
        'auditor_id' => $auditor->id,
        'interaction_id' => $interaction->id,
        'type' => 'mcq',
        'replyable_data' => [
            'id' => $questionChoice->id,
        ],
    ]);

    $response->assertStatus(200);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeTrue();
});

it('can store survey answer', function () {
    $auditor = Auditor::factory()->create();
    $user = User::factory()->create([
        'name' => 'test',
        'email' => 'testa@example.com',
        'password' => Hash::make('password'),
        'roleable_id' => $auditor->id,
        'roleable_type' => get_class($auditor),
    ]);
    $interaction = Interaction::factory()->create([
        'type' => 'survey',
    ]);
    $questionChoice = QuestionChoice::factory()->create(['interaction_id' => $interaction->id]);

    $this->actingAs($user);

    $response = postJson('/answer', [
        'auditor_id' => $auditor->id,
        'interaction_id' => $interaction->id,
        'type' => 'survey',
        'replyable_data' => [
            'id' => $questionChoice->id,
        ],
    ]);

    $response->assertStatus(200);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeTrue();
});

it('can not store answer for invalid type', function () {
    $auditor = Auditor::factory()->create();
    $user = User::factory()->create([
        'name' => 'test',
        'email' => 'tests@example.com',
        'password' => Hash::make('password'),
        'roleable_id' => $auditor->id,
        'roleable_type' => get_class($auditor),
    ]);
    $interaction = Interaction::factory()->create([
        'type' => 'text',
    ]);

    $this->actingAs($user);

    $response = postJson('/answer', [
        'auditor_id' => $auditor->id,
        'interaction_id' => $interaction->id,
        'type' => 'invalid_type',
        'replyable_data' => [
            'content' => 'This is a text answer.',
        ],
    ]);

    $response->assertStatus(422);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeFalse();
});

it('can not store answer media picture for audio type', function () {
    $auditor = Auditor::factory()->create();
    $user = User::factory()->create([
        'name' => 'test',
        'email' => 'tesct@example.com',
        'password' => Hash::make('password'),
        'roleable_id' => $auditor->id,
        'roleable_type' => get_class($auditor),
    ]);
    $interaction = Interaction::factory()->create([
        'type' => 'audio',
    ]);

    $this->actingAs($user);

    $response = postJson('/answer', [
        'auditor_id' => $auditor->id,
        'interaction_id' => $interaction->id,
        'type' => 'audio',
        'replyable_data' => [
            'path' => 'path/to/media',
            'type' => 'video',
        ],
    ]);

    $response->assertStatus(422);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeFalse();
});

it('can not store answer for incorrect interaction type', function () {
    $auditor = Auditor::factory()->create();
    $user = User::factory()->create([
        'name' => 'test',
        'email' => 'tescdt@example.com',
        'password' => Hash::make('password'),
        'roleable_id' => $auditor->id,
        'roleable_type' => get_class($auditor),
    ]);
    $interaction = Interaction::factory()->create([
        'type' => 'text',
    ]);

    $this->actingAs($user);

    $response = postJson('/answer', [
        'auditor_id' => $auditor->id,
        'interaction_id' => $interaction->id,
        'type' => 'picture',
        'replyable_data' => [
            'path' => 'path/to/media',
            'type' => 'picture',
        ],
    ]);

    $response->assertStatus(422);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeFalse();
});
