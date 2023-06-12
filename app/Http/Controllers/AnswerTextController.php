<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerTextRequest;
use App\Models\AnswerText;

class AnswerTextController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnswerTextRequest $request)
    {
        $validated = $request->validated();
        $answerText = AnswerText::create($validated);

        return response()->json($answerText, 201);
    }
}
