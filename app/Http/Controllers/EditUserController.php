<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EditUserController extends Controller
{
    //
    /*public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'user_role' => 'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_role = $request->user_role;
        $user->save();
        return redirect()->back()->with('success', 'User created successfully');
    }*/
    public function edit($id)
    {
        $user = User::find($id);
        return view('user', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = bcrypt($request->new_password);
        } else {
            return redirect()->back()->with('error', 'Old password is incorrect');
        }
        $user->save();
        return redirect()->route('user.update', $user)->with('success', 'User updated successfully');
    }
    public function activation($id)
    {
        $user = User::findOrFail($id);

        // Toggle user status
        $user->user_status = $user->user_status == 1 ? 0 : 1;

        // Save the changes
        $user->save();

        // Return response with updated status
        return response()->json([
            'message' => 'User status updated successfully',
            'user_status' => $user->user_status // Include updated user status
        ]);
    }
}
