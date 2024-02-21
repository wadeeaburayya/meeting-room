<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['room_name', 'room_availability', 'room_users', 'room_status'];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
