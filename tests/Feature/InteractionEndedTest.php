<?php

use App\Events\InteractionEndedEvent;
use App\Events\InteractionEndedForAnimatorEvent;
use App\Jobs\CheckInteractionEnded;
use App\Models\Answer;
use App\Models\Auditor;
use App\Models\Interaction;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;

uses(DatabaseTransactions::class);

it('ends the interaction when ended_at time is reached', function () {

    Event::fake();

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

    // Act: Call the job's handle method
    $job = new CheckInteractionEnded($interaction);
    $job->handle();

    // Assert: Check the interaction and its answers
    $interaction->refresh();
    expect($interaction->answers)->toHaveCount(3);

    // Check that each answer has the correct auditor associated
    foreach ($interaction->answers as $answer) {
        expect($answer->auditor_id)->toBe($auditor->id);
    }

    // Assert that the correct events were dispatched
    Event::assertDispatched(InteractionEndedEvent::class, function ($event) use ($interaction) {
        return $event->interaction->id === $interaction->id;
    });

    Event::assertDispatched(InteractionEndedForAnimatorEvent::class, function ($event) use ($interaction, $auditor) {
        return $event->interaction->id === $interaction->id && $event->answers[0]->auditor_id === $auditor->id;
    });
});
