<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['room_name', 'room_floor'];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'room_access_control');
    }
    public function roomAccessControl()
    {
        return $this->hasMany(RoomAccessControl::class);
    }
}
