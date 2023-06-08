<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Interaction;
use App\Settings\GeneralSettings;
use Inertia\Inertia;

class AnimatorController extends Controller
{
    public function index(GeneralSettings $settings)
    {
        // Récupérer l'interaction en cours
        $interaction = Interaction::where('ended_at', '>', now())->first();

        return Inertia::render('Animator/Index', [
            'chatEnabled' => $settings->chat_enabled,
            'interaction' => $interaction,
        ]);
    }
}
