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
            'interaction' => Interaction::active()->with([
                'answers' => [
                    'auditor' => [
                        'user',
                    ],
                    'replyable',
                ],
                'call_to_action',
                'question_choices',
            ])->first(),
        ]);
    }

    public function endEmission(GeneralSettings $settings)
    {
        $settings->chat_enabled = false;
        $settings->save();

        ChatUpdated::dispatch($settings->chat_enabled);

        $currentInteraction = Interaction::active()->first();
        $currentInteraction->update([
            'ended_at' => now(),
            'status' => InteractionStatus::STOPPED,
        ]);

        event(new InteractionEndedEvent($currentInteraction));

        // Collect all answers && rewards
        $answers = $currentInteraction->answers()->with('auditor')->get();
        $rewards = Reward::all();

        event(new InteractionEndedForAnimatorEvent($currentInteraction, $answers, $rewards));

        return to_route('animator.index');
    }
}
