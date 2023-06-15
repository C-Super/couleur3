<?php

namespace App\Http\Controllers;

use App\Enums\InteractionType;
use App\Events\AnswerQuestionChoiceSubmited;
use App\Events\AnswerSubmitedToAnimator;
use App\Http\Requests\Answer\StoreAnswerQuestionChoiceRequest;
use App\Http\Requests\Answer\StoreAnswerTextRequest;
use App\Http\Requests\Answer\StoreAnswerRequest;
use App\Models\Answer;
use App\Models\AnswerText;
use App\Models\Interaction;
use App\Models\Media;
use App\Models\QuestionChoice;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Storage;

class AnswerController extends Controller
{
    public function storeQuickClick(Interaction $interaction)
    {
        $answer = Answer::create([
            'auditor_id' => Auth::user()->id,
            'interaction_id' => $interaction->id,
        ])->load('auditor.user');

        broadcast(new AnswerSubmitedToAnimator($answer))->toOthers();
    }

    public function storeText(StoreAnswerTextRequest $request, Interaction $interaction)
    {
        $validated = $request->validated();

        $replyable = AnswerText::create(['content' => $validated['content']]);

        $answer = Answer::create([
            'auditor_id' => Auth::user()->id,
            'interaction_id' => $interaction->id,
            'replyable_id' => $replyable->id,
            'replyable_type' => get_class($replyable),
        ])->load('auditor.user');

        broadcast(new AnswerSubmitedToAnimator($answer))->toOthers();
    }

    public function storeQuestionChoice(StoreAnswerQuestionChoiceRequest $request, Interaction $interaction)
    {
        $validated = $request->validated();
        $questionChoiceChosed = $validated['questionChoiceChosed'];

        $replyable = QuestionChoice::find($questionChoiceChosed);

        $answer = Answer::create([
            'auditor_id' => Auth::user()->id,
            'interaction_id' => $interaction->id,
            'replyable_id' => $replyable->id,
            'replyable_type' => get_class($replyable),
        ])->load('auditor.user');

        broadcast(new AnswerQuestionChoiceSubmited($answer))->toOthers();
    }
}
