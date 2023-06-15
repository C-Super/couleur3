<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('interactions.{id}', function (User $user, int $id) {
    return $user->isAnimator();
});

Broadcast::channel('auditors.{id}', function (User $user, int $id) {
    return $user->id === $id;
});

Broadcast::channel('public', function () {
    return true;
});
