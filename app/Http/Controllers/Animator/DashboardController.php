<?php

namespace App\Http\Controllers\Animator;

use App\Events\ChatUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Animator\UpdateChatRequest;
use App\Models\Message;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(GeneralSettings $settings)
    {
        return Inertia::render('Animator/Dashboard', [
            'chatEnabled' => $settings->chat_enabled,
        ]);
    }

    public function updateChatSetting(UpdateChatRequest $request, GeneralSettings $settings)
    {
        $validated = $request->validated();

        if ($validated['chat_enabled'] === true && $settings->chat_enabled) {
            return back()->with([
                'error', 'Le chat est déjà activé.',
                'chatEnabled' => $settings->chat_enabled,
            ]);
        }

        if ($validated['chat_enabled'] === false && ! $settings->chat_enabled) {
            return back()->with([
                'error', 'Le chat est déjà désactivé.',
                'chatEnabled' => $settings->chat_enabled,
            ]);
        }

        $settings->chat_enabled = $validated['chat_enabled'];
        $settings->save();

        ChatUpdated::dispatch($settings->chat_enabled);

        if ($settings->chat_enabled) {
            return back()->with([
                'success', 'Le chat a bien été activé.',
                'chatEnabled' => $settings->chat_enabled,
            ]);
        }

        return back()->with([
            'success', 'Le chat a bien été désactivé.',
            'chatEnabled' => $settings->chat_enabled,
            'messages' => [],
        ]);
    }
}
