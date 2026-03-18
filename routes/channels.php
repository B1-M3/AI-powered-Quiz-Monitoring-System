<?php

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    $uid = $user->user_id ?? $user->id ?? null;
    return $uid && (int) $uid === (int) $id;
});

// STEP 25: Apexia quiz attempt channel (real-time proctoring alerts to lecturer)
Broadcast::channel('quiz.attempt.{attemptId}', function ($user, $attemptId) {
    $attempt = \App\Models\QuizAttempt::find($attemptId);
    if (!$attempt || !$attempt->quiz) {
        return false;
    }
    return $user->isDeveloper() || $user->user_id === $attempt->quiz->created_by;
});
