<?php

namespace App\Http\Controllers;

use App\Events\InteractionSent;
use App\Http\Requests\StoreInteractionRequest;
use App\Models\CallToAction;
use App\Models\Interaction;
use App\Models\QuestionChoice;
use Inertia\Inertia;

class InteractionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer toutes les interactions et les retourner
        $interactions = Interaction::all();

        return response()->json($interactions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(Interaction $interaction)
    {
        // Récupérer l'interaction et la retourner
        $interaction = Interaction::findOrFail($interaction->id);

        return response()->json($interaction);
    }

    public function store(StoreInteractionRequest $request)
    {
        // Initialize $cta to null
        $cta = null;

        // Then, depending on the type of interaction, create the call_to_action or question_choice
        if ($request->type === 'survey' || $request->type === 'mcq') {
            $validated = $request->validated();
            $interaction = Interaction::create($validated);
            foreach ($validated['question_choice_data'] as $questionChoiceData) {
                QuestionChoice::create(array_merge($questionChoiceData, ['interaction_id' => $interaction->id]));
            }
            $interaction->load('question_choices');
        } elseif ($request->type === 'cta' || $request->type === 'quick_click') {
            $validated = $request->validated();
            foreach ($request->call_to_action_data as $ctaData) {
                $cta = CallToAction::create($ctaData);
            }
            $interaction = Interaction::create(array_merge($validated, ['call_to_action_id' => $cta->id]));
            $interaction->load('call_to_action');
        } else {
            $validated = $request->validated();
            $interaction = Interaction::create($validated);
        }

        $response = ['message' => 'Interaction created', 'interaction' => $interaction];

        broadcast(new InteractionSent($response))->toOthers();

        return Inertia::render('Animator/Interaction/Show', $interaction);
    }
}
