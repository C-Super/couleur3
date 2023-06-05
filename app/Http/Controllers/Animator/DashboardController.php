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
        if (! $settings->chat_enabled) {
            return Inertia::render('Animator/Dashboard', [
                'messages' => [],
                'chatEnabled' => $settings->chat_enabled,
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
