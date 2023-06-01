<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInteractionRequest;
use App\Models\CallToAction;
use App\Models\Interaction;
use App\Models\QuestionChoice;

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
        } elseif ($request->type === 'cta' || $request->type === 'quick_click') {
            $validated = $request->validated();
            foreach ($request->call_to_action_data as $ctaData) {
                $cta = CallToAction::create($ctaData);
            }
            $interaction = Interaction::create(array_merge($validated, ['call_to_action_id' => $cta->id]));

        } else {
            $validated = $request->validated();
            $interaction = Interaction::create($validated);
        }

        $response = ['message' => 'Interaction created', 'interaction' => $interaction];

        return response()->json($response, 201);
    }
}
