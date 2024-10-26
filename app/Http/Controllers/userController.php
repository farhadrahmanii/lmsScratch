<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function UserDashboard()
    {
        return view('dashboard');
    }
    public function home()
    {
        return view('frontend.index');
    }
    public function UserProfile()
    {
        $id = Auth::user()->id;

        $user = User::findOrFail($id);

        return view('frontend.dashboard.edit_profile', ['user' => $user]);
    }

    public function UserProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/' . $user->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $user['photo'] = $filename;
        }
        $user->save();
        $notification = array(
            'message' => 'user Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
