<?php

use App\Enums\InteractionType;
use App\Events\AnswerQuestionChoiceSubmited;
use App\Events\AnswerSubmitedToAnimator;
use App\Models\Answer;
use App\Models\AnswerText;
use App\Models\Auditor;
use App\Models\Interaction;
use App\Models\Media;
use App\Models\QuestionChoice;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;

uses(DatabaseTransactions::class);

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\postJson;

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
        'type' => InteractionType::TEXT,
    ]);

    $this->actingAs($user);

    $response = postJson("/interactions/{$interaction->id}/answers/text", [
        'content' => 'This is a text answer.',
    ]);

    $response->assertStatus(200);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeTrue();
    expect(AnswerText::where('content', 'This is a text answer.')->exists())->toBeTrue();

    Event::assertDispatched(AnswerSubmitedToAnimator::class, function ($event) use ($auditor) {
        return $event->answer->auditor_id === $auditor->id;
    });

    Event::assertNotDispatched(AnswerQuestionChoiceSubmited::class);
})->skip('Answer text is not implemented yet');

it('can store media answer and fires correct events', function () {
    Event::fake([AnswerSubmitedToAnimator::class, AnswerQuestionChoiceSubmited::class]);

    $auditor = Auditor::factory()->create();
    $user = User::factory()->create([
        'name' => 'test',
        'email' => 'test2@example.com',
        'password' => Hash::make('password'),
        'roleable_id' => $auditor->id,
        'roleable_type' => get_class($auditor),
    ]);
    $interaction = Interaction::factory()->create([
        'type' => InteractionType::PICTURE,
    ]);

    $this->actingAs($user);

    $testImagePath = base_path('tests/resources/test.jpeg'); // Path vers un vrai fichier JPEG de test
    $image = new UploadedFile($testImagePath, 'test.jpeg', 'image/jpeg', null, true);
    $response = postJson("/interactions/{$interaction->id}/answers/picture", [
        'file' => $image,
    ]);

    $response->assertStatus(200);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeTrue();

    $answer = Answer::where('auditor_id', $auditor->id)->first();
    expect(Media::where('id', $answer->replyable_id)->exists())->toBeTrue();

    Event::assertDispatched(AnswerSubmitedToAnimator::class, function ($event) use ($auditor) {
        return $event->answer->auditor_id === $auditor->id;
    });

    Event::assertNotDispatched(AnswerQuestionChoiceSubmited::class);
})->skip('Answer picture is not implemented yet');

it('can store mcq answer and fires correct events', function () {
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
        'type' => InteractionType::MCQ,
    ]);
    $questionChoice = QuestionChoice::factory()->create(['interaction_id' => $interaction->id]);

    $this->actingAs($user);

    $response = postJson("/interactions/{$interaction->id}/answers/mcq", [
        'id' => $questionChoice->id,
    ]);

    $response->assertStatus(200);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeTrue();
    expect(QuestionChoice::where('id', $questionChoice->id)->exists())->toBeTrue();

    Event::assertDispatched(AnswerSubmitedToAnimator::class, function ($event) use ($auditor) {
        return $event->answer->auditor_id === $auditor->id;
    });

    Event::assertDispatched(AnswerQuestionChoiceSubmited::class);
})->skip('Answer mcq is not implemented yet');

it('can store survey answer and fires correct events', function () {
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
        'type' => InteractionType::SURVEY,
    ]);
    $questionChoice = QuestionChoice::factory()->create(['interaction_id' => $interaction->id]);

    $this->actingAs($user);

    $response = postJson("/interactions/{$interaction->id}/answers/survey", [
        'id' => $questionChoice->id,
    ]);

    $response->assertStatus(200);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeTrue();
    expect(QuestionChoice::where('id', $questionChoice->id)->exists())->toBeTrue();

    Event::assertDispatched(AnswerSubmitedToAnimator::class, function ($event) use ($auditor) {
        return $event->answer->auditor_id === $auditor->id;
    });

    Event::assertDispatched(AnswerQuestionChoiceSubmited::class);
})->skip('Answer survey is not implemented yet');

it('can not store answer for invalid type and fires correct events', function () {
    Event::fake([AnswerSubmitedToAnimator::class, AnswerQuestionChoiceSubmited::class]);

    $auditor = Auditor::factory()->create();
    $user = User::factory()->create([
        'name' => 'test',
        'email' => 'tests@example.com',
        'password' => Hash::make('password'),
        'roleable_id' => $auditor->id,
        'roleable_type' => get_class($auditor),
    ]);
    $interaction = Interaction::factory()->create([
        'type' => InteractionType::TEXT,
    ]);

    $this->actingAs($user);

    $response = postJson("/interactions/{$interaction->id}/answers/mcq", [
        'content' => 'This is a text answer.',
    ]);

    $response->assertStatus(422);
    expect(Answer::where('auditor_id', $auditor->id)->exists())->toBeFalse();

    Event::assertNotDispatched(AnswerSubmitedToAnimator::class, function ($event) use ($auditor) {
        return $event->answer->auditor_id === $auditor->id;
    });

    Event::assertNotDispatched(AnswerQuestionChoiceSubmited::class);
})->skip('Answer is not implemented yet');
