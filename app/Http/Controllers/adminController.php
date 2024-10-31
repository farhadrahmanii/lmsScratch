<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class adminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    } //End Method

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/login');
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;

        $admin = User::findOrFail($id);

        return view('admin.profile', ['admin' => $admin]);
    }
    public function Store(Request $request)
    {
        $id = Auth::user()->id;

        $admin = User::findOrFail($id);
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
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
            @unlink(public_path('upload/admin_images/' . $admin->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $admin['photo'] = $filename;
        }

        $admin->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $admin = User::findOrFail($id);
        return view('admin.admin_change_password', ['admin' => $admin]);
    }

    public function adminPasswordUpdate(Request $request)
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

    }// End Method

    //Instructor Routes here 
    public function BecomeInstructor()
    {
        return view('frontend.instructor.reg_instructor');
    }
    public function StoreInstructor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
        ]);

        $datauser = User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'instructor',
            'status' => '0'
        ]);

        $notification = array(
            'message' => 'Instructor Registration Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('instructor.login')->with($notification);

    }
    // Instructor Admin Dashboard methods
    public function AllInstructor()
    {
        $allinstructors = User::where('role', 'instructor')->latest()->get();

        return view('admin.backend.instructor.all_instructor', compact('allinstructors'));
    }
    // User Status update to instructor to user and then revert of it
    public function UpdateUserStatus(Request $request)
    {
        $user_id = $request->input('user_id');
        $status = $request->input('status', 0);

        $user = User::findOrFail($user_id);
        $user->status = $status;
        $user->save();

        return response()->json(['message' => 'User Status Updated Successfully']);

    }

}
