<?php

namespace App\Http\Controllers;

use App\Events\AnswerQuestionChoiceSubmited;
use App\Events\AnswerSubmitedToAnimator;
use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;
use App\Models\AnswerText;
use App\Models\Media;
use App\Models\QuestionChoice;
use Inertia\Inertia;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnswerRequest $request)
    {
        $$validated = $request->validated();
        dump($validated);

        switch ($request->type) {
            case 'text':
                $answerable = AnswerText::create($validated['replyable_data']);
                break;
            case 'audio':
            case 'video':
            case 'picture':
                $answerable = Media::create($validated['replyable_data']);
                break;
            case 'mcq':
            case 'survey':
                $answerable = QuestionChoice::find($validated['replyable_data']['id']);
                break;
            default:
                return response()->json(['message' => 'Invalid type'], 400);
        }

        $answer = Answer::create([
            'auditor_id' => $validated['auditor_id'],
            'interaction_id' => $validated['interaction_id'],
            'replyable_id' => $answerable->id,
            'replyable_type' => get_class($answerable),
        ]);

        // Broadcast AnswerSubmitedToAnimator event in all cases
        broadcast(new AnswerSubmitedToAnimator($answer))->toOthers();

        // For MCQ and Survey type, also broadcast AnswerQuestionChoiceSubmited event
        if ($request->type === 'mcq' || $request->type === 'survey') {
            broadcast(new AnswerQuestionChoiceSubmited($answer))->toOthers();
        }

        return Inertia::render('Auditor/Answer', $answer);
    }
}
