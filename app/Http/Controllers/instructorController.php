<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class instructorController extends Controller
{
    public function InstructorDashboard()
    {
        return view('instructor.index');
    } // End Method

    public function InstructorlogOut(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('instructor/login');
    }
    public function InstructorLogin()
    {
        return view('instructor.instructor_login');
    } // End Method
    public function InstructorProfile()
    {
        $id = Auth::user()->id;
        $instructor = User::find($id);
        return view('instructor.instructor_profile', ['instructor' => $instructor]);
    } // End Method

    public function Store(Request $request)
    {
        $id = Auth::user()->id;

        $instructor = User::findOrFail($id);
        $instructor->name = $request->name;
        $instructor->username = $request->username;
        $instructor->email = $request->email;
        $instructor->phone = $request->phone;
        $instructor->address = $request->address;
        // $request->validate([
        //     'name' => 'required',
        //     'username' => 'required',
        //     'email' => ['required', 'email'],
        //     'phone' => ['required', 'numeric'],
        //     'photo' => ['required'],
        //     'address' => ['nullable'],
        // ]);

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/instructor_images/' . $instructor->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/instructor_images'), $filename);
            $instructor['photo'] = $filename;
        }

        $instructor->save();

        $notification = array(
            'message' => 'instructor Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function InstructorChangePassword()
    {
        $id = Auth::user()->id;
        $instructor = User::findOrFail($id);
        return view('instructor.instructor_change_password', ['instructor' => $instructor]);
    }

    public function instructorPasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $hashedPassword = Auth::user()->password;
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => 'Old Password Does Not Match',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

}
