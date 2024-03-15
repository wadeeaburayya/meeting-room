<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\Reservation;
use App\Models\RoomAccessControl;
use App\Models\Notification;

class MeetingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $rooms = [];
        $users = [];
        $reservations = [];
        $selectedRoomId = request('selectedRoomId');
        if (!$selectedRoomId) {
            return redirect()->route('selectRoom');
        }
        $date = request('date');
        $reservations = Reservation::where('room_id', $selectedRoomId)->get();
        $roomName = '';
        if ($user->user_role == 1) {
            $rooms = Room::all();
            $users = User::all();
        } else {
            $roomAccess = RoomAccessControl::where('user_id', $user->id)->pluck('room_id')->toArray();
            $rooms = Room::whereIn('id', $roomAccess)->get();
            if (!in_array($selectedRoomId, $roomAccess)) {
                return redirect()->route('selectRoom');
            }
            $roomAccessUser = RoomAccessControl::where('room_id', $selectedRoomId)->where('user_id', '!=', auth()->id())->pluck('user_id')->toArray();
            $users = User::whereIn('id', $roomAccessUser)->get();
        }
        $timeslots = [
            '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'
        ];
        $days = [
            (object)['name' => 'Monday'],
            (object)['name' => 'Tuesday'],
            (object)['name' => 'Wednesday'],
            (object)['name' => 'Thursday'],
            (object)['name' => 'Friday'],
            (object)['name' => 'Saturday']
        ];
        return view('page', compact('rooms', 'users', 'reservations', 'selectedRoomId', 'days', 'timeslots', 'date', 'roomName'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'reservation_topic' => 'required|string|max:255',
            'reservation_description' => 'required|string',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'room_id' => 'required|integer',
            'attendees' => 'nullable|array',
            'attendees.*' => 'nullable|integer',
        ]);
        try {
            $reservation = new Reservation();
            $reservation->fill($validatedData);
            $reservation->save();
            if ($request->has('attendees')) {
                foreach ($request->attendees as $attendeeId) {
                    $notification = new Notification();
                    $notification->user_id = $attendeeId;
                    $notification->message = 'You have been invited to (' . $reservation->reservation_topic . ') meeting on ' . $reservation->start_time . ' in room ' . $reservation->room->room_name . ' by ' . $reservation->user->name . ' please check your meetings for more details.';
                    $notification->save();
                }
            }
            return response()->json(['message' => 'Reservation created successfully', 'reservationTopic' => $reservation->reservation_topic, 'startTime' => $reservation->start_time], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'message' => 'Please fill all fields'], 500);
        }
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'reservation_topic' => 'required|string|max:255',
            'reservation_description' => 'required|string',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'room_id' => 'required|integer',
            'id' => 'required|integer'
        ]);
        try {
            $reservation = Reservation::find($validatedData['id']);
            $reservation->fill($validatedData);
            $reservation->save();
            return response()->json(['message' => 'Reservation updated successfully', 'reservationTopic' => $reservation->reservation_topic, 'startTime' => $reservation->start_time], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'message' => 'Please fill all fields'], 500);
        }
    }
}
