<?php
use Illuminate\Support\Facades\Log;
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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chatroom.{id}', function ($user,$id) {
    return $user;
});

Broadcast::channel('comment', function ($comment) {
    return $comment;
});

Broadcast::channel('subComment', function ($subComment) {
    return $subComment;
});

Broadcast::channel('commentLike', function ($commentLike) {
    return $commentLike;
});

Broadcast::channel('postLike', function ($postLike) {
    return $postLike;
});
