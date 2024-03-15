<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    //
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->where('seen', false)
            ->get();
        return view('notifications', [
            'notifications' => $notifications
        ]);
    }
    public function isSeen($id)
    {
        $notification = Notification::find($id);
        $notification->seen = true;
        $notification->save();
        return redirect()->back();
    }
}
