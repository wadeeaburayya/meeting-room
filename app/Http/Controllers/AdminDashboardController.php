<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Meeting;
class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        $usersCount = $users->count();
        $rooms = Room::all();
        $roomsCount = $rooms->count();
        $userAdmin = User::where('user_role', 1)->count();
        return view('admin.dashboard', compact('users', 'usersCount', 'rooms', 'roomsCount', 'userAdmin'));
    }
}
