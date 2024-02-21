<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;

class RoomController extends Controller
{
    //
    public function index()
    {
        $rooms = Room::all();
        $roomsCount = Room::count();

        return view('dashboard', compact('rooms, roomsCount'));
    }
}
