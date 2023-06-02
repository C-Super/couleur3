<?php

namespace App\Http\Controllers;

use App\Events\AnimatorSent;
use App\Events\AuditorSent;
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
        $answer = null;
        $validated = $request->validated();
        dump($validated);

        if ($request->type === 'text') {
            $answerText = AnswerText::create($validated['replyable_data']);
            $answer = Answer::create([
                'auditor_id' => $validated['auditor_id'],
                'interaction_id' => $validated['interaction_id'],
                'replyable_id' => $answerText->id,
                'replyable_type' => get_class($answerText),
            ]);
        } elseif ($request->type === 'picture' || $request->type === 'video' || $request->type === 'audio') {
            $answerMedia = Media::create($validated['replyable_data']);
            $answer = Answer::create([
                'auditor_id' => $validated['auditor_id'],
                'interaction_id' => $validated['interaction_id'],
                'replyable_id' => $answerMedia->id,
                'replyable_type' => get_class($answerMedia),
            ]);
        } elseif ($request->type === 'mcq' || $request->type === 'survey') {
            $questionChoice = QuestionChoice::find($validated['replyable_data']['id']);
            $answer = Answer::create([
                'auditor_id' => $validated['auditor_id'],
                'interaction_id' => $validated['interaction_id'],
                'replyable_id' => $questionChoice->id,
                'replyable_type' => get_class($questionChoice),
            ]);

            //if question_choice linked interaction is survey, send broadcast to auditor
            if ($request->type === 'survey') {
                $response = ['message' => 'Interaction created', 'interaction' => $answer];
                broadcast(new AuditorSent($response))->toOthers();
            }
        } else {
            return response()->json(['message' => 'Invalid type'], 400);
        }

        $response = ['message' => 'Interaction created', 'interaction' => $answer];

        broadcast(new AnimatorSent($response))->toOthers();

        return Inertia::render('Auditor/Answer', $answer);
    }
}
