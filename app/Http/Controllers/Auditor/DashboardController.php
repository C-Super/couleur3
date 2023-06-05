<?php

namespace App\Http\Controllers\Auditor;

use App\Events\AuditorSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auditor\StoreMessageRequest;
use App\Models\Auditor;
use App\Models\Message;
use App\Settings\GeneralSettings;
use DB;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(GeneralSettings $settings): Response
    {
        if (! $settings->chat_enabled) {
            return Inertia::render('Auditor/Dashboard', [
                'chatEnabled' => $settings->chat_enabled,
                'messages' => [],
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

        return Inertia::render('Auditor/Dashboard', [
            'chatEnabled' => $settings->chat_enabled,
            'messages' => array_reverse($lastMessages),
        ]);
    }

    public function storeMessage(StoreMessageRequest $request)
    {
        $validated = $request->validated();

        $user = Auth::user();
        $auditor = $user->roleable;

        if (! $auditor instanceof Auditor) {
            return Inertia::render('Error', [
                'status' => '403: '.__('http-statuses.403'),
                'message' => "Vous n'êtes pas un auditeur.",
            ])->toResponse($request)->setStatusCode(403);
        }

        $message = $auditor->messages()->create([
            'content' => $validated['content'],
        ])->toArray();

        $message['user_name'] = $user->name;

        MessageSent::dispatch($message);
    }
}
