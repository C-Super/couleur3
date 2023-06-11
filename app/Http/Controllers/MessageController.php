<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\Auditor\StoreMessageRequest;
use Auth;

class MessageController extends Controller
{
    public function store(StoreMessageRequest $request)
    {
        $validated = $request->validated();

        /** @var \App\Models\User $user */
        $user = Auth::user();
        /** @var \App\Models\Auditor $auditor */
        $auditor = $user->roleable;

        $message = $auditor->messages()->create([
            'content' => $validated['content'],
        ])->toArray();

        $message['user_name'] = $user->name;

        MessageSent::dispatch($message);
    }
}
