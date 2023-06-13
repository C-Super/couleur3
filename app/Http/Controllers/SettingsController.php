<?php

namespace App\Http\Controllers;

use App\Events\ChatUpdated;
use App\Http\Requests\Animator\UpdateChatRequest;
use App\Settings\GeneralSettings;

class SettingsController extends Controller
{
    public function update(UpdateChatRequest $request, GeneralSettings $settings)
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

        broadcast(new ChatUpdated($settings->chat_enabled))->toOthers();

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
