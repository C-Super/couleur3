<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInteractionRequest;
use App\Models\Answer;
use App\Models\Interaction;
use App\Models\CallToAction;
use App\Models\QuestionChoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use App\Rules\ValidCtaData;
use App\Rules\ValidQuestionChoiceData;

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

        // Then, depending on the type of interaction, create the call_to_action or question_choice
        if ($request->type === 'survey' || $request->type === 'mcq') {
            $validated = $request->validated();
            $interaction = Interaction::create($validated);
            foreach ($validated['question_choice_data'] as $questionChoiceData) {
                QuestionChoice::create(array_merge($questionChoiceData, ['interaction_id' => $interaction->id]));
            }
        }
        elseif ($request->type === 'cta' || $request->type === 'quick_click') {
            $validated = $request->validated();
            foreach ($request->call_to_action_data as $ctaData) {
                $cta = CallToAction::create($ctaData);
            }
            $interaction = Interaction::create(array_merge($validated, ['call_to_action_id' => $cta->id]));

        }
        else{
            $validated = $request->validated();
            $interaction = Interaction::create($validated);
        }

        $response = ['message' => 'Interaction created', 'interaction' => $interaction];

        return response()->json($response, 201);
    }

    private function createCallToActionInteraction($interaction, $callToActionData)
    {
        foreach($callToActionData as $data) {
            $validator = Validator::make($data, [
                '*' => [new ValidCtaData],
            ]);
            $validatedData = $validator->validate();

            CallToAction::create(array_merge($validatedData, ['interaction_id' => $interaction->id]));
        }
    }

    private function createQuestionChoiceInteraction($interaction, $questionChoiceData)
    {
        foreach($questionChoiceData as $data) {

            $validator = Validator::make($data, [
                '*' => [new ValidQuestionChoiceData],
            ]);
            $validatedData = $validator->validate();

            QuestionChoice::create(array_merge($validatedData, ['interaction_id' => $interaction->id]));
        }
    }
}
