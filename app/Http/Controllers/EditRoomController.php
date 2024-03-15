<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\RoomAccessControl;
use Exception;

class EditRoomController extends Controller
{
    //
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $selectedUsers = RoomAccessControl::where('room_id', $id)->pluck('user_id')->toArray();

        $users = User::all();
        return view('roomDetails', compact('room', 'users', 'selectedUsers'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'room_name' => 'required',
            'room_floor' => 'required',
            'users' => 'required|array|min:1'
        ]);
        $room = Room::find($id);
        $room->room_name = $request->room_name;
        $room->room_floor = $request->room_floor;
        try {
            $room->users()->sync($request->users);
            $room->save();
            return response()->json([
                'success' => 'Room updated successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to update room: ' . $e->getMessage(),
            ]);
        }
    }
    public function activation($id)
    {
        $room = Room::findOrFail($id);

        // Toggle user status
        $room->room_status = $room->room_status == 1 ? 0 : 1;

        // Save the changes
        $room->save();

        // Return response with updated status
        return response()->json([
            'message' => 'Room updated successfully',
            'room' => $room
        ]);
    }
}
