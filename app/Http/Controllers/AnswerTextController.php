<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerTextRequest;
use App\Http\Requests\UpdateAnswerTextRequest;
use App\Models\AnswerText;

class AnswerTextController extends Controller
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
    public function store(StoreAnswerTextRequest $request)
    {
        $validated = $request->validated();
        $answerText = AnswerText::create($validated);

        return response()->json($answerText, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AnswerText $answerText)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnswerText $answerText)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnswerTextRequest $request, AnswerText $answerText)
    {
        $validated = $request->validated();
        $answerText->update($validated);

        return response()->json($answerText, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnswerText $answerText)
    {
        $answerText->delete();

        return response()->json(null, 204);
    }
}
