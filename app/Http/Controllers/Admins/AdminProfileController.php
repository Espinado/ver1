<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admins\Admin;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function showProfile()
    {
        $adminData = Admin::where('id', Auth('admin')->user()->id)->first();
        return view('admin.admins.profile', compact('adminData'));
    }

    public function editProfile()
    {
        $adminProfileData = Auth('admin')->user();
        return view('admin.admins.profile_edit', compact('adminProfileData'));
    }

    public function updateProfile(Request $request)
    {
        $data = Admin::where('id', Auth('admin')->user()->id)->first();
        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('admin_images/' . $data->profile_photo_path));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('admin_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();
        $notification = array('message' => 'Admin profile updated', 'alert-type' => 'success');
        return redirect()->route('admin.profile')->with($notification);
    }

    public function changePassword()
    {
        return view('admin.admins.changePasswordForm');
    }

    public function updatePassword(Request $request)
    {
        $validateData = $request->validate(['oldpassword' => 'required', 'password' => 'required|confirmed']);
        $hashedPassword = Auth('admin')->user()->first();
        if (Hash::check($request->oldpassword, $hashedPassword->password)) {
            $admin = Auth('admin')->user()->first();
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::guard('admin')->logout();
            $notification = array('message' => 'Admin profile updated', 'alert-type' => 'success');
            return redirect()->route('login_form')->with($notification);
        } else {
            $notification = array('message' => 'Error', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

    }
}
