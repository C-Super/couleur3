<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use App\Settings\GeneralSettings;
use Inertia\Inertia;
use Inertia\Response;

class AuditorController extends Controller
{
    public function index(GeneralSettings $settings): Response
    {
        return Inertia::render('Auditor/Index', [
            'chatEnabled' => $settings->chat_enabled,
            'interaction' => Interaction::active()->with([
                'answers' => [
                    'auditor' => [
                        'user',
                    ],
                    'replyable',
                ],
                'callToAction',
                'questionChoices',
            ])->first(),
        ]);
    }
}
