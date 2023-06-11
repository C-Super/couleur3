<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionChoiceRequest;
use App\Http\Requests\UpdateQuestionChoiceRequest;
use App\Models\QuestionChoice;

class QuestionChoiceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionChoiceRequest $request)
    {
        $validated = $request->validated();
        $questionChoice = QuestionChoice::create($validated);

        return response()->json($questionChoice, 201);
    }
}
