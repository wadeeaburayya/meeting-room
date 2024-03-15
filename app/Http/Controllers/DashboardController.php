<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use App\Models\RoomAccessControl;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (auth()->user()->user_role == 1) {
            $rooms = Room::all();
            $users = User::all();
            $roomsCount = Room::count();
            $usersCount = User::count();
            $userAdmin = User::where('user_role', 1)->count();
            $reservations = Reservation::all();
            $ongoingReservations = Reservation::where('start_time', '<=', Carbon::now())
                ->where('end_time', '>', Carbon::now())
                ->get();
            $upcomingReservations = Reservation::where('start_time', '>', Carbon::now())
                ->get();
            return view('dashboard', compact('rooms', 'users', 'roomsCount', 'usersCount', 'userAdmin', 'reservations', 'ongoingReservations', 'upcomingReservations'));
        } else {    
            $roomAccess = RoomAccessControl::where('user_id', auth()->user()->id)->pluck('room_id')->toArray();
            $ongoingReservations = Reservation::whereIn('room_id', $roomAccess)
                ->where('start_time', '<=', Carbon::now())
                ->where('end_time', '>', Carbon::now())
                ->get();
            $upcomingReservations = Reservation::whereIn('room_id', $roomAccess)
                ->where('start_time', '>', Carbon::now())
                ->get();
            return view('dashboard', compact('ongoingReservations', 'upcomingReservations'));
        }
    }
}
