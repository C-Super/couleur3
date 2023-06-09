<?php

namespace App\Http\Controllers;

use App\Enums\InteractionType;
use App\Http\Requests\StoreCallToActionRequest;
use App\Models\CallToAction;
use App\Models\Interaction;
use Inertia\Inertia;

class CallToActionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCallToActionRequest $request)
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

        return Inertia::render('Animator/Index', [
            'interaction' => $interaction,
        ]);
    }
}
