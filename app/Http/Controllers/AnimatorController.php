<?php

namespace App\Http\Controllers;

use App\Enums\InteractionStatus;
use App\Events\ChatUpdated;
use App\Events\InteractionEndedEvent;
use App\Events\InteractionEndedForAnimatorEvent;
use App\Models\Interaction;
use App\Models\Reward;
use App\Settings\GeneralSettings;
use Inertia\Inertia;

class AnimatorController extends Controller
{
    public function index(GeneralSettings $settings)
    {
        return Inertia::render('Animator/Index', [
            'chatEnabled' => $settings->chat_enabled,
            'interaction' => Interaction::pending()->with([
                'answers' => [
                    'auditor' => [
                        'user',
                    ],
                    'replyable',
                ],
                'callToAction',
                'questionChoices',
            ])->first(),
            'rewards' => Reward::all()
        ]);
    }

    public function endEmission(GeneralSettings $settings)
    {
        $settings->chat_enabled = false;
        $settings->save();

        ChatUpdated::dispatch($settings->chat_enabled);

        $currentInteraction = Interaction::pending()->first();
        $currentInteraction->update([
            'ended_at' => now(),
            'status' => InteractionStatus::STOPPED,
        ]);

        broadcast(new InteractionEndedEvent($currentInteraction))->toOthers();

        return redirect()->back()->with([
            'chatEnabled' => $settings->chat_enabled,
            'interaction' => null,
        ]);
    }
}
