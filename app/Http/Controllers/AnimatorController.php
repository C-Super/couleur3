<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use App\Settings\GeneralSettings;
use Inertia\Inertia;

class AnimatorController extends Controller
{
    public function index(GeneralSettings $settings)
    {
        return Inertia::render('Animator/Index', [
            'chatEnabled' => $settings->chat_enabled,
            'interaction' => Interaction::active()->first(),
        ]);
    }
}
