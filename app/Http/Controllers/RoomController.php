<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $users = User::all();
        return view('rooms', compact('rooms', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_name' => 'required',
            'room_floor' => 'required',
            'users' => 'required|array|min:1'
        ]);

        // Create the room
        $room = new Room();
        $room->room_name = $request->room_name;
        $room->room_floor = $request->room_floor;
        $room->save();

        // Attach selected users to the room
        $room->users()->attach($request->users);


        return redirect()->back()->with('success', 'Room created successfully');
    }
}
