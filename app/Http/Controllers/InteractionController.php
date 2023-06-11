<?php

namespace App\Http\Controllers;

use App\Enums\InteractionStatus;
use App\Enums\InteractionType;
use App\Events\InteractionCreated;
use App\Events\InteractionEndedEvent;
use App\Events\InteractionEndedForAnimatorEvent;
use App\Http\Requests\StoreCallToActionRequest;
use App\Http\Requests\StoreInteractionRequest;
use App\Jobs\CheckInteractionEnded;
use App\Models\CallToAction;
use App\Models\Interaction;
use App\Models\Reward;
use DateTime;
use Inertia\Inertia;

class InteractionController extends Controller
{
    public function store(StoreInteractionRequest $request)
    {
        // Initialize $cta to null
        $cta = null;

        $validated = $request->validated();

        // Then, depending on the type of interaction, create the call_to_action or question_choice
        if ($request->type === 'survey' || $request->type === 'mcq') {

            $interaction = Interaction::create($validated);
            foreach ($validated['question_choice_data'] as $questionChoiceData) {
                $interaction->question_choices()->create($questionChoiceData);
            }
            $interaction->load('question_choices');
        } elseif ($request->type === 'cta' || $request->type === 'quick_click') {
            foreach ($request->call_to_action_data as $ctaData) {
                $cta = CallToAction::create($ctaData);
            }
            $interaction = Interaction::create(array_merge($validated, ['call_to_action_id' => $cta->id]));
            $interaction->load('call_to_action');
        } else {
            $interaction = Interaction::create($validated);
        }

        if ($interaction->ended_at) {
            $ended_at = new DateTime($interaction->ended_at);
            $delay = $ended_at->getTimestamp() - now()->getTimestamp();

            if ($delay > 0) {
                CheckInteractionEnded::dispatch($interaction)->delay($delay);
            }
        }

        $response = ['message' => 'Interaction created', 'interaction' => $interaction];

        broadcast(new InteractionCreated($interaction))->toOthers();

        $reward = Reward::all();

        return Inertia::render('Animator/Interaction/Show', [
            'interaction' => $interaction,
            'rewards' => $reward,
        ]);
    }

    public function storeCTA(StoreCallToActionRequest $request)
    {
        $validated = $request->validated();

        $cta = CallToAction::create($validated);
        $interaction = new Interaction();

        $interaction->title = $validated['title'];
        $interaction->type = InteractionType::CTA;
        $interaction->call_to_action_id = $cta->id;
        $interaction->animator_id = auth()->user()->id;
        $interaction->ended_at = now()->addSeconds($validated['duration']);

        $interaction->save();

        return response()->json([
            'message' => 'Call to action created successfully',
            'interaction' => $interaction,
        ]);
    }

    /**
     * Manually end interaction
     */
    public function endInteraction(Interaction $interaction)
    {
        $interaction->update(['ended_at' => now(), 'status' => InteractionStatus::PENDING->value]);
        $interaction->refresh();

        event(new InteractionEndedEvent($interaction));

        // Collect all answers && rewards
        $answers = $interaction->answers()->with('auditor')->get();
        $rewards = Reward::all();

        event(new InteractionEndedForAnimatorEvent($interaction, $answers, $rewards));

        $reward = Reward::all();

        return Inertia::render('Animator/Interaction/Show', [
            'interaction' => $interaction,
            'rewards' => $reward,
        ]);
    }
}
