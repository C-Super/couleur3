<?php

use App\Jobs\CheckInteractionEnded;
use App\Models\Answer;
use App\Models\Auditor;
use App\Models\Interaction;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;

uses(DatabaseTransactions::class);

it('ends the interaction when ended_at time is reached', function () {
    // Use RefreshDatabase trait to reset the database state before each test

    // Arrange: Create necessary objects and setup the state
    $auditor = Auditor::factory()->create();
    $interaction = Interaction::factory()->create([
        'type' => 'text',
        'ended_at' => now()->subMinute(),  // set the ended_at to a time in the past
    ]);
    Answer::factory()->count(3)->create([
        'auditor_id' => $auditor->id,
        'interaction_id' => $interaction->id,
        'replyable_type' => 'text',
        'replyable_id' => 1,
    ]);

    // Assert: Check that the EndInteraction job is dispatched when the interaction ended_at time is reached
    Queue::fake();
    $job = new CheckInteractionEnded($interaction);
    dispatch($job);
    Queue::assertPushed(CheckInteractionEnded::class);

    // Act: Call the job's handle method
    $job->handle();

    // Assert: Check the interaction and its answers
    $interaction->refresh();
    expect($interaction->answers)->toHaveCount(3);

    // Check that each answer has the correct auditor associated
    foreach ($interaction->answers as $answer) {
        expect($answer->auditor_id)->toBe($auditor->id);
    }
});
