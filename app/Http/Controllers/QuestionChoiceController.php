<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionChoiceRequest;
use App\Http\Requests\UpdateQuestionChoiceRequest;
use App\Models\QuestionChoice;

class QuestionChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionChoiceRequest $request)
    {
        $validated = $request->validated();
        $questionChoice = QuestionChoice::create($validated);

        return response()->json($questionChoice, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(QuestionChoice $questionChoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuestionChoice $questionChoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionChoiceRequest $request, QuestionChoice $questionChoice)
    {
        $validated = $request->validated();
        $questionChoice->update($validated);

        return response()->json($questionChoice, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionChoice $questionChoice)
    {
        $questionChoice->delete();

        return response()->json(null, 204);
    }
}
