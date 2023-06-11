<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\Auditor\StoreMessageRequest;
use App\Models\Auditor;
use Auth;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function store(StoreMessageRequest $request)
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
