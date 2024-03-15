<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $primaryKey = 'reservation_id';

    protected $fillable = ['room_id', 'user_id', 'start_time', 'end_time', 'reservation_topic', 'reservation_description', 'reservation_status'];

    // Define the date attributes for casting
    protected $casts = ['start_time'  => 'datetime', 'end_time' => 'datetime'];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
