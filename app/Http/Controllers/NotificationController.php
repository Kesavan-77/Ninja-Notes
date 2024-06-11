<?php

namespace App\Http\Controllers;

use App\Notifications\UserFollowNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function notify()
    {
        $notifications = auth()->user()->notifications;
        return view('notes.notification')->with('notifications',$notifications);
    }
}
