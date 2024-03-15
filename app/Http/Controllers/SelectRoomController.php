<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\RoomAccessControl;
use Illuminate\Support\Facades\Log;

class SelectRoomController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        if ($user->user_role == 1) {
            $rooms = Room::all();
            return view('selectRoom', compact('rooms'));
        } else {
            $roomAccess = RoomAccessControl::where('user_id', $user->id)->pluck('room_id')->toArray();
            $rooms = Room::whereIn('id', $roomAccess)->get();
            return view('selectRoom', compact('rooms'));
        }
    }
}
