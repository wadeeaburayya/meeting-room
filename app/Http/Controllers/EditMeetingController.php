<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Exception;

class EditMeetingController extends Controller
{
    //
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        if($reservation->reservation_status == 1 || $reservation->reservation_status == 0){
            return view('meetingDetails', compact('reservation'));
        }else{
            return redirect()->route('page');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'reservation_topic' => 'required',
            'reservation_description' => 'required'
        ]);
        $reservation = Reservation::find($id);
        $reservation->reservation_topic = $request->reservation_topic;
        $reservation->reservation_description = $request->reservation_description;
        try {
            $reservation->save();
            return response()->json([
                'success' => 'Reservation updated successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to update reservation: ' . $e->getMessage(),
            ]);
        }
    }
    public function activation(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        if ($request->has('reservation_status') && $request->input('reservation_status') == '1') {
            $reservation->reservation_status = 1; // Yes
        } else {
            $reservation->reservation_status = 2; // No
        }
        try {
            $reservation->save();
            if ($reservation->reservation_status == 1) {
                return response()->json([
                    'success' => 'Reservation is confirmed successfully',
                ]);
            } else {
                return response()->json([
                    'success' => 'Reservation is cancelled successfully',
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to update reservation: ' . $e->getMessage(),
            ]);
        }
    }
}
