<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservation;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    //
    public function index()
    {
        $reservations = Reservation::all();
        $ongoingReservations = Reservation::where('start_time', '<=', Carbon::now())
            ->where('end_time', '>', Carbon::now())
            ->get();
        $upcomingReservations = Reservation::where('start_time', '>', Carbon::now())
            ->get();
        Log::info('Upcoming reservations: ' . $upcomingReservations);

        return view('dashboard', compact('reservations', 'ongoingReservations', 'upcomingReservations'));
    }
}
