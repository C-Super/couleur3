<?php

namespace App\Http\Controllers;

use App\Enums\InteractionType;
use App\Events\AnswerQuestionChoiceSubmited;
use App\Events\AnswerSubmitedToAnimator;
use App\Http\Requests\StoreAnswerRequest;
use App\Settings\GeneralSettings;
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
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnswerRequest $request)
    {
        $validated = $request->validated();

        /** @var \App\Models\User $user */
        $user = Auth::user();
        /** @var \App\Models\Auditor $auditor */
        $auditor = $user->roleable;

        switch ($request->type) {
            case InteractionType::TEXT->value:
                $answerable = AnswerText::create($validated['replyable_data']);
                break;
            case InteractionType::AUDIO->value:
            case InteractionType::VIDEO->value:
            case InteractionType::PICTURE->value:
                // Récupérez le fichier de la requête
                $file = $request->file('replyable_data.file');

                // Générer un nom de fichier unique
                $fileName = time().'_'.$file->getClientOriginalName();

                // Envoyez le fichier au disque minio
                Storage::disk('s3')->put($fileName, file_get_contents($file));

                // Créez le modèle Media avec le chemin du fichier dans MinIO
                $answerable = Media::create([
                    'type' => $validated['replyable_data']['type'],
                    'path' => $fileName,  // Utilisez le nom de fichier généré comme chemin
                ]);
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

        return Inertia::render('Auditor/Index', $answer);
    }

    public function storeQuickClick(Request $request, Interaction $interaction, GeneralSettings $settings)
    {
        $answer = Answer::create([
            'auditor_id' => Auth::user()->id,
            'interaction_id' => $interaction->id,
        ]);

        $answer->with('auditor.user')->get();

        broadcast(new AnswerSubmitedToAnimator($answer))->toOthers();
    }
}
