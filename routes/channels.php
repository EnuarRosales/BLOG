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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;   
});
// TODO revisar la autenticación para los channels
Broadcast::channel('modelUpdates', function (User $user, int $orderId) {
    return true;
});

Broadcast::channel('private-event.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;

});
