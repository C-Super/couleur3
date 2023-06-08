<?php

namespace App\Http\Controllers;

use App\Enums\InteractionType;
use App\Events\AnswerQuestionChoiceSubmited;
use App\Events\AnswerSubmitedToAnimator;
use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;
use App\Models\AnswerText;
use App\Models\Auditor;
use App\Models\Media;
use App\Models\QuestionChoice;
use Illuminate\Support\Facades\Auth;
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
        $validated = $request->validated();

        //get user id from auth
        $user = Auth::user();
        $auditor = $user->roleable;

        if (! $auditor instanceof Auditor) {
            return Inertia::render('Error', [
                'status' => '403: '.__('http-statuses.403'),
                'message' => "Vous n'êtes pas un auditeur.",
            ])->toResponse($request)->setStatusCode(403);
        }

        switch ($request->type) {
            case InteractionType::TEXT->value:
                $answerable = AnswerText::create($validated['replyable_data']);
                break;
            case InteractionType::AUDIO->value:
            case InteractionType::VIDEO->value:
            case InteractionType::PICTURE->value:
                $answerable = Media::create($validated['replyable_data']);
                break;
            case InteractionType::MCQ->value:
            case InteractionType::SURVEY->value:
                $answerable = QuestionChoice::find($validated['replyable_data']['id']);
                break;
            default:
                return response()->json(['message' => 'Invalid type'], 400);
        }

        $answer = Answer::create([
            'auditor_id' => $auditor->id,
            'interaction_id' => $validated['interaction_id'],
            'replyable_id' => $answerable->id,
            'replyable_type' => get_class($answerable),
        ]);

        // Broadcast AnswerSubmitedToAnimator event in all cases
        broadcast(new AnswerSubmitedToAnimator($answer))->toOthers();

        // For MCQ and Survey type, also broadcast AnswerQuestionChoiceSubmited event
        if ($request->type === InteractionType::MCQ->value || $request->type === InteractionType::SURVEY->value) {
            broadcast(new AnswerQuestionChoiceSubmited($answer))->toOthers();
        }

        return Inertia::render('Auditor/Answer', $answer);
    }
}
