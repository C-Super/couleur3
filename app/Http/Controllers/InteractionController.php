<?php

namespace App\Http\Controllers;

use App\Enums\InteractionType;
use App\Events\InteractionCreated;
use App\Http\Requests\Interaction\StoreCallToActionRequest;
use App\Http\Requests\Interaction\StoreQuickClickRequest;
use App\Http\Requests\StoreInteractionRequest;
use App\Jobs\CheckInteractionEnded;
use App\Models\CallToAction;
use App\Models\Interaction;
use App\Models\Reward;
use Auth;
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
        /** @var \App\Models\User $user */
        $user = Auth::user();
        /** @var \App\Models\Animator $animator */
        $animator = $user->roleable;

        $interaction->title = $validated['title'];
        $interaction->type = InteractionType::CTA;
        $interaction->call_to_action_id = $cta->id;
        $interaction->animator_id = $animator->id;
        $interaction->ended_at = now()->addSeconds($validated['duration']);

        $interaction->save();

        broadcast(new InteractionCreated($interaction))->toOthers();

        return redirect()->back()->with([
            'interaction' => Interaction::active()->with([
                'answers' => [
                    'auditor' => [
                        'user',
                    ],
                    'replyable',
                ],
                'call_to_action',
                'question_choices',
            ])->first(),
        ]);
    }

    public function storeQuickClick(StoreQuickClickRequest $request)
    {
        $validated = $request->validated();

        $quick_click = CallToAction::create($validated);
        $interaction = new Interaction();
        /** @var \App\Models\User $user */
        $user = Auth::user();
        /** @var \App\Models\Animator $animator */
        $animator = $user->roleable;

        $interaction->title = $validated['title'];
        $interaction->type = InteractionType::QUICK_CLICK;
        $interaction->call_to_action_id = $quick_click->id;
        $interaction->animator_id = $animator->id;
        $interaction->ended_at = now()->addSeconds($validated['duration']);

        $interaction->save();

        broadcast(new InteractionCreated($interaction))->toOthers();

        return redirect()->back()->with([
            'interaction' => Interaction::active()->with([
                'answers' => [
                    'auditor' => [
                        'user',
                    ],
                    'replyable',
                ],
                'call_to_action',
                'question_choices',
            ])->first(),
        ]);
    }

    public function endInteraction(Interaction $interaction)
    {
        $interaction->update(['ended_at' => now()]);

        return redirect()->back()->with([
            'interaction' => null,
        ]);
    }
}
