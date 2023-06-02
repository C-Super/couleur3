<?php

namespace App\Http\Controllers\Animator;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralSettingsRequest;
use App\Models\Message;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(GeneralSettings $settings)
    {
        if (! $settings->is_chat_enabled) {
            return Inertia::render('Animator/Dashboard', [
                'messages' => [],
                'isChatEnabled' => $settings->is_chat_enabled,
            ]);
        }

        $lastMessages = Message::orderByDesc('messages.created_at')
            ->take(10)
            ->join('auditors', 'auditors.id', '=', 'messages.auditor_id')
            ->join('users', function ($join) {
                $join->on('users.roleable_type', '=', DB::raw('"App\\\Models\\\Auditor"'))
                    ->on('users.roleable_id', '=', 'auditors.id');
            })
            ->select('messages.*', 'users.name as user_name')
            ->get()
            ->toArray();

        return Inertia::render('Animator/Dashboard', [
            'messages' => array_reverse($lastMessages),
            'isChatEnabled' => $settings->is_chat_enabled,
        ]);
    }

    public function updateChatSetting(GeneralSettingsRequest $request, GeneralSettings $settings)
    {
        $validated = $request->validated();

        if ($validated['is_chat_enabled'] === true && $settings->is_chat_enabled) {
            return back()->with([
                'error', 'Le chat est déjà activé.',
                'isChatEnabled' => $settings->is_chat_enabled,
            ]);
        }

        if ($validated['is_chat_enabled'] === false && ! $settings->is_chat_enabled) {
            return back()->with([
                'error', 'Le chat est déjà désactivé.',
                'isChatEnabled' => $settings->is_chat_enabled,
            ]);
        }

        $settings->is_chat_enabled = $validated['is_chat_enabled'];
        $settings->save();

        if ($settings->is_chat_enabled) {
            return back()->with([
                'success', 'Le chat a bien été activé.',
                'isChatEnabled' => $settings->is_chat_enabled,
            ]);
        }

        return back()->with([
            'success', 'Le chat a bien été désactivé.',
            'isChatEnabled' => $settings->is_chat_enabled,
            'messages' => [],
        ]);
    }
}
