<?php

namespace App\Http\Controllers\Back;

use App\ {
    Models\User,
    Http\Controllers\Controller
};
use Illuminate\ {
    Http\Request,
    Notifications\DatabaseNotification
};

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('back.notifications.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Notifications\DatabaseNotification $notification
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, DatabaseNotification $notification)
    {
        $notification->markAsRead();

        if($request->user()->unreadNotifications->isEmpty()) {
            return redirect()->route('posts.index');
        }

        return back();
    }
}
