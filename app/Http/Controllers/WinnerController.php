<?php

namespace App\Http\Controllers;

use App\Enums\InteractionType;
use App\Events\NewWinnerGenerated;
use App\Events\WinnerSentResult;
use App\Http\Requests\ReplaceWinnerRequest;
use App\Http\Requests\Winner\GenerateWinnersRequest;
use App\Http\Requests\Winner\StoreWinnerRequest;
use App\Models\Answer;
use App\Models\Interaction;
use App\Models\Winner;
use DB;

class WinnerController extends Controller
{
    public function generateRandomList(GenerateWinnersRequest $request, Interaction $interaction)
    {
        $validated = $request->validated();
        $winnersCount = $validated['winners_count'];
        $reward_id = $validated['reward_id'];

        // Insert into interaction reward_id
        $interaction->update(['reward_id' => $reward_id]);

        // Initialisez la requête pour récupérer les IDs des auditeurs
        $query = Answer::where('answers.interaction_id', $interaction->id)
            ->whereNotIn('auditor_id', Winner::where('interaction_id', $interaction->id)->pluck('auditor_id'));

        // Si l'interaction est de type QCM
        if ($interaction->type == InteractionType::MCQ) {
            $query->join('question_choices', function ($join) {
                $join->on('answers.replyable_id', '=', 'question_choices.id')
                    ->where('answers.replyable_type', '=', 'App\Models\QuestionChoice')
                    ->where('question_choices.is_correct_answer', '=', true);
            });
        }

        // Ordonne de façon aléatoire et prends le nombre spécifié de gagnants
        $auditorIds = $query->inRandomOrder()
            ->take($winnersCount)
            ->pluck('answers.auditor_id')
            ->toArray();

        // Créer les gagnants
        $winners = [];
        foreach ($auditorIds as $auditorId) {
            $winner = Winner::create([
                'interaction_id' => $interaction->id,
                'auditor_id' => $auditorId,
            ]);
            array_push($winners, $winner);
        }

        // Lancer un événement pour les gagnants
        foreach ($winners as $winner) {
            broadcast(new WinnerSentResult($winner->auditor_id, $interaction->reward));
        }

        return back()->with([
            'interaction' => [
                'winners' => $winners,
            ],
        ]);
    }

    public function generateFastestList(GenerateWinnersRequest $request, Interaction $interaction)
    {
        $validated = $request->validated();
        $winnersCount = $validated['winners_count'];
        $reward_id = $validated['reward_id'];

        // Insert into interaction reward_id
        $interaction->update(['reward_id' => $reward_id]);

        // Initialise la requête pour récupérer les IDs des auditeurs les plus rapides
        $query = Answer::where('answers.interaction_id', $interaction->id)
            ->whereNotIn('auditor_id', Winner::where('interaction_id', $interaction->id)->pluck('auditor_id'))
            ->with(['auditor.user']);

        // Si l'interaction est de type QCM, joignez avec la table question_choices et filtrez seulement les bonnes réponses
        if ($interaction->type == InteractionType::MCQ) {
            $query->join('question_choices', function ($join) {
                $join->on('answers.replyable_id', '=', 'question_choices.id')
                    ->where('answers.replyable_type', '=', 'App\Models\QuestionChoice')
                    ->where('question_choices.is_correct_answer', '=', true);
            });
        }

        // Ordonne par date de création et prends le nombre spécifié de gagnants
        $auditorIds = $query->orderBy('answers.created_at')
            ->take($winnersCount)
            ->pluck('answers.auditor_id')
            ->toArray();

        // Créer les gagnants
        $winners = [];
        foreach ($auditorIds as $auditorId) {
            $winner = Winner::create([
                'interaction_id' => $interaction->id,
                'auditor_id' => $auditorId,
            ]);

            array_push($winners, $winner);
        }

        // Lancer un événement pour les gagnants
        foreach ($winners as $winner) {
            broadcast(new WinnerSentResult($winner->auditor_id, $interaction->reward));
        }

        return back()->with([
            'interaction' => [
                'winners' => $winners,
            ],
        ]);
    }

    public function generateReplace(ReplaceWinnerRequest $request)
    {
        $validated = $request->validated();
        $interaction_id = $validated['interaction_id'];
        $auditor_id = $validated['auditor_id'];

        // Get a random auditor who answered the interaction and is not already a winner and is not the provided auditor id
        $newAuditorId = Answer::where('interaction_id', $interaction_id)
            ->where('auditor_id', '!=', $auditor_id)
            ->whereNotIn('auditor_id', Winner::where('interaction_id', $interaction_id)->pluck('auditor_id'))
            ->inRandomOrder()
            ->first()
            ->auditor_id;

        //Store temp winner
        Winner::create([
            'interaction_id' => $interaction_id,
            'auditor_id' => $newAuditorId,
        ]);

        //delete old winner
        Winner::where('interaction_id', $interaction_id)
            ->where('auditor_id', $auditor_id)
            ->delete();

        // Dispatch an event with the new auditor id
        broadcast(new NewWinnerGenerated([$newAuditorId]));

        return response()->json(['new_auditor_id' => $newAuditorId], 200);
    }

    public function store(StoreWinnerRequest $request, Interaction $interaction)
    {
        $validated = $request->validated();

        $winners_id = $validated['winners'];
        $reward_id = $validated['reward_id'];

        // Insert into interaction reward_id
        $interaction->update(['reward_id' => $reward_id]);

        DB::transaction(function () use ($interaction, $winners_id) {
            // Delete all existing winners for the interaction
            Winner::where('interaction_id', $interaction->id)->delete();

            // Créer de nouveaux gagnants pour l'interaction
            foreach ($winners_id as $winner_id) {
                Winner::create([
                    'interaction_id' => $interaction->id,
                    'auditor_id' => $winner_id,
                ]);
            }
        });

        // Dispatch an event to notify the new winners
        foreach ($winners_id as $winner_id) {
            broadcast(new WinnerSentResult($winner_id, $interaction->reward));
        }

        return back()->with([
            'interaction' => [
                'winners' => $winners_id,
            ],
        ]);
    }
}
