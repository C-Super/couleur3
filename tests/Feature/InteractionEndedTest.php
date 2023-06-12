<?php

use App\Enums\InteractionType;
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
    $auditors = Auditor::factory()->count(3)->create();
    $interaction = Interaction::factory()->create([
        'type' => InteractionType::TEXT,
        'ended_at' => now()->subMinute(),  // set the ended_at to a time in the past
    ]);
    //create answer for interaction with each of the auditors
    foreach ($auditors as $auditor) {
        Answer::factory()->create([
            'interaction_id' => $interaction->id,
            'auditor_id' => $auditor->id,
        ]);
    }

    // Act: Call the job's handle method
    $job = new CheckInteractionEnded($interaction);
    $job->handle();

    // Assert: Check the interaction and its answers
    $interaction->refresh();
    expect($interaction->answers)->toHaveCount(3);

    // Check that each answer has the correct auditor associated
    $auditor_ids = $auditors->pluck('id')->toArray();
    foreach ($interaction->answers as $answer) {
        expect(in_array($answer->auditor_id, $auditor_ids))->toBeTrue();
    }

    // Assert that the correct events were dispatched
    Event::assertDispatched(InteractionEndedEvent::class, function ($event) use ($interaction) {
        return $event->interaction->id === $interaction->id;
    });

    Event::assertDispatched(InteractionEndedForAnimatorEvent::class);
});
