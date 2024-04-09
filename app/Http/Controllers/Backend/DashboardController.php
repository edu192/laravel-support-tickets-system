<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.index', ['tickets' => Ticket::all(), 'users' => User::all()]);
    }

    public function profile_edit()
    {
        return view('backend.profile.index', ['user' => auth()->user()]);
    }

    public function profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        toastr()->success('Profile updated successfully!');
        return redirect()->route('backend.profile.edit');
    }

    public function profile_update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'current_password:web|required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = auth()->user();
        $user->password = $request->password;
        $user->save();
        toastr()->success('Password updated successfully!');
        return redirect()->route('backend.profile.edit');
    }
}
