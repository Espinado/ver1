<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('customers.profile.profile', compact('user'));
    }

    public function profileEdit()
    {
        $user = Auth::user();
        return view('customers.profile.profile_edit', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $data = User::where('id', Auth::user()->id)->first();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            @unlink(public_path('user_images/' . $data->profile_photo_path));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('user_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();
        $notification = array('message' => 'User profile updated', 'alert-type' => 'success');
        return redirect()->route('profile.index')->with($notification);
    }

    public function changePassword()
    {
        $user = Auth::user();
        return view('customers.profile.change_pass', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);
        $hashedPassword = Auth::user()->first();

        if (Hash::check($request->oldpassword, $hashedPassword->password)) {
            $user = Auth::user()->first();
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            $notification = array('message' => 'Password changed', 'alert-type' => 'success');
            return redirect()->route('index')->with($notification);
        } else {
            $notification = array('message' => 'Error', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
}
