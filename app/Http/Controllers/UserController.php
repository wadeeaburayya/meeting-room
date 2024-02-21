<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $usersCount = User::count();
        $userAdmin = User::where('user_role', 1)->count();

        return view('dashboard', compact('users', 'usersCount', 'userAdmin'));
    }
}
