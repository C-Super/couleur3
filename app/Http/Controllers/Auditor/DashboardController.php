<?php

namespace App\Http\Controllers\Auditor;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use DB;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Route;

class DashboardController extends Controller
{
    public function index()
    {
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
            'messages' => array_reverse($lastMessages),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function storeMessage(StoreMessageRequest $request)
    {
        $validated = $request->validated();

        $user = Auth::user();
        $auditor = $user->roleable;

        $message = $auditor->messages()->create([
            'content' => $validated['message'],
        ])->toArray();

        $message['user_name'] = $user->name;

        broadcast(new MessageSent($message))->toOthers();

        return back()->with('status', 'Message sent!');
    }
}
