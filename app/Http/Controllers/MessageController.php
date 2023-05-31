<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $auditor = $user->roleable;

        $message = $auditor->messages()->create([
            'content' => $request->input('message')
        ]);

        broadcast(new MessageSent($auditor, $message))->toOthers();

        return $message;
    }
}
