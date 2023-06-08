<?php

namespace App\Http\Controllers\Auditor;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auditor\StoreMessageRequest;
use App\Models\Auditor;
use App\Settings\GeneralSettings;
use Auth;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(GeneralSettings $settings): Response
    {
        return Inertia::render('Auditor/Home', [
            'chatEnabled' => $settings->chat_enabled,
        ]);
    }

    public function storeMessage(StoreMessageRequest $request)
    {
        $validated = $request->validated();

        $user = Auth::user();
        $auditor = $user->roleable;

        if (!$auditor instanceof Auditor) {
            return Inertia::render('Error', [
                'status' => '403: ' . __('http-statuses.403'),
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
