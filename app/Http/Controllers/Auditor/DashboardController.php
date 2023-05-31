<?php

namespace App\Http\Controllers\Auditor;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function storeMessage(Request $request)
    {
        $user = Auth::user();
        $auditor = $user->roleable;

        $message = $auditor->messages()->create([
            'content' => $request->input('message'),
        ]);

        $message['user_name'] = $user->name;

        MessageSent::dispatch($message);

        return response()->json([
            'message' => 'Message sent!',
            'data' => $message,
        ]);
    }
}
