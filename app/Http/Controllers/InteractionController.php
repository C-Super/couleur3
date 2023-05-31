<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInteractionRequest;
use App\Http\Requests\UpdateInteractionRequest;
use App\Models\Interaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Winner;

class InteractionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer toutes les interactions et les retourner
        $interactions = Interaction::all();
        return response()->json($interactions);
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
    public function show(Interaction $interaction)
    {
        // Récupérer l'interaction et la retourner
        $interaction = Interaction::findOrFail($interaction->id);
        return response()->json($interaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInteractionRequest $request, Interaction $interaction)
    {
        $interaction = Interaction::findOrFail($interaction->id);
        $interaction->fill($request->validated());
        $interaction->save();

        return response()->json($interaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interaction $interaction)
    {
        // Récupérer l'interaction
        $interaction = Interaction::findOrFail($interaction->id);

        // Supprimer l'interaction
        $interaction->delete();

        // Retourner une réponse indiquant que la suppression a réussi
        return response()->json(['message' => 'Interaction deleted successfully']);
    }


    public function end(Interaction $interaction)
    {
        // Trouver l'interaction
        $interaction = Interaction::findOrFail($interaction->id);

        // Vérifier si l'utilisateur actuel est l'animateur de l'interaction
        if (Auth::user()->id != $interaction->animator_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Terminer l'interaction
        $interaction->ended_at = now();
        $interaction->save();

        // Pusher pour notifier les auditeurs de la fin de l'interaction

        return response()->json(['message' => 'Interaction ended successfully']);
    }

    public function respond(Request $request, Interaction $interaction)
    {
        // À faire : validation des données d'entrée

        // Trouver l'interaction
        $interaction = Interaction::findOrFail($interaction->id);

        // Créer une nouvelle réponse
        $answer = new Answer($request->all());
        $answer->auditor_id = Auth::user()->id;
        $answer->interaction_id = $interaction->id;

        // Enregistrer la réponse
        $answer->save();

        // Pusher pour notifier l'animateur de la nouvelle réponse

        return response()->json($answer, 201);
    }

    public function designateWinner(Request $request, $id)
    {
        // À faire : validation des données d'entrée

        // Trouver l'interaction
        $interaction = Interaction::findOrFail($id);

        // Vérifier si l'utilisateur actuel est l'animateur de l'interaction
        if (Auth::user()->id != $interaction->animator_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Créer une nouvelle entrée gagnante
        $winner = new Winner($request->all());
        $winner->interaction_id = $interaction->id;

        // Enregistrer le gagnant
        $winner->save();

        // Pusher pour notifier l'auditeur gagnant de la victoire

        return response()->json($winner, 201);
    }
}
