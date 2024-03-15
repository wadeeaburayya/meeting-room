<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;
class UpdateReservationStatus extends Command
{
    protected $signature = 'reservations:update_status';
    protected $description = 'Update reservation status from 0 to 3';
    public function handle()
    {
        // Set the time zone to 'Europe/Nicosia' (Nicosia time zone)
        $now = Carbon::now('Europe/Nicosia')->format('Y-m-d H:i:s');
        $reservationsConfirmed = Reservation::where('end_time', '<', $now)->where('reservation_status', 1)->get();
        foreach ($reservationsConfirmed as $reservation) {
            $reservation->update(['reservation_status' => 4]);
        }
        $reservationsPending = Reservation::where('start_time', '<', $now)->where('reservation_status', 0)->get();
        foreach ($reservationsPending as $reservation) {
            $reservation->update(['reservation_status' => 3]);
        }
        
        $this->info('Meeting statuses updated successfully.');
    }
}
