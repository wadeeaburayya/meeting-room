<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAccessControl extends Model
{
    use HasFactory;

    protected $table = 'room_access_control'; // Specify the table name explicitly

    protected $fillable = ['room_id', 'user_id'];
}
