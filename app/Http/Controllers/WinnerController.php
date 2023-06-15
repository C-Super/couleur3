<?php

namespace App\Http\Controllers;

use App\Events\NewWinnerGenerated;
use App\Events\WinnerSentResult;
use App\Events\WinnersListGenerated;
use App\Http\Requests\ReplaceWinnerRequest;
use App\Http\Requests\StoreWinnerRequest;
use App\Http\Requests\Winner\GenerateWinnersRequest;
use App\Models\Answer;
use App\Models\Interaction;
use App\Models\Reward;
use App\Models\Winner;
use DB;

class WinnerController extends Controller
{
    public function generateRandomList(GenerateWinnersRequest $request, Interaction $interaction)
    {
        $validated = $request->validated();
        $winnersCount = $validated['winners_count'];

        // Récupérer les IDs de tous les auditeurs qui ont répondu à l'interaction et qui ne sont pas déjà des gagnants
        $auditorIds = Answer::where('interaction_id', $interaction->id)
            ->whereNotIn('auditor_id', Winner::where('interaction_id', $interaction->id)->pluck('auditor_id'))
            ->inRandomOrder()
            ->take($winnersCount)
            ->pluck('auditor_id')
            ->toArray();

        //Store temp winners
        foreach ($auditorIds as $auditorId) {
            Winner::create([
                'interaction_id' => $interaction->id,
                'auditor_id' => $auditorId,
            ]);
        }

        // Dispatch an event with the auditor list
        event(new WinnersListGenerated($auditorIds));

        return response()->json(['auditor_ids' => $auditorIds], 200);
    }

    public function generateFastestList(GenerateWinnersRequest $request, Interaction $interaction)
    {
        $validated = $request->validated();
        $winnersCount = $validated['winners_count'];
        $reward_id = $validated['reward_id'];

        // Insert into interaction reward_id
        $interaction->update(['reward_id' => $reward_id]);

        // Récupérer les IDs des auditeurs les plus rapides qui ont répondu à l'interaction et qui ne sont pas déjà des gagnants
        $auditorIds = Answer::where('interaction_id', $interaction->id)
            ->whereNotIn('auditor_id', Winner::where('interaction_id', $interaction->id)->pluck('auditor_id'))
            ->orderBy('created_at')
            ->with(['auditor.user'])
            ->take($winnersCount)
            ->pluck('auditor_id')
            ->toArray();

        //Store temp winner
        $winners = [];
        foreach ($auditorIds as $auditorId) {
            $winner = Winner::create([
                'interaction_id' => $interaction->id,
                'auditor_id' => $auditorId,
            ]);

            array_push($winners, $winner);
        }

        // Broadcast an event to winners
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
        event(new NewWinnerGenerated([$newAuditorId]));

        return response()->json(['new_auditor_id' => $newAuditorId], 200);
    }

    public function store(StoreWinnerRequest $request)
    {
        $validated = $request->validated();

        $interaction_id = $validated['interaction_id'];
        $auditor_ids = $validated['auditor_ids'];
        $reward = Reward::find($validated['reward_id']);

        DB::transaction(function () use ($interaction_id, $auditor_ids, $validated) {
            // Delete all existing winners for the interaction

            Winner::where('interaction_id', $interaction_id)->delete();

            // Créer de nouveaux gagnants pour l'interaction
            foreach ($auditor_ids as $auditor_id) {
                Winner::create([
                    'interaction_id' => $interaction_id,
                    'auditor_id' => $auditor_id,
                ]);
            }

            // Insert into interaction reward_id
            DB::table('interactions')
                ->where('id', $interaction_id)
                ->update(['reward_id' => $validated['reward_id']]);
        });

        // Dispatch an event to notify the new winners
        foreach ($auditor_ids as $auditor_id) {
            event(new WinnerSentResult($auditor_id, $reward));
        }

        return response()->json(['message' => 'Winners stored successfully.'], 200);
    }
}
