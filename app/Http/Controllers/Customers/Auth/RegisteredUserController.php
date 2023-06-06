<?php

namespace App\Http\Controllers\Customers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use App\Events\UserRegistered;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('customers.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' =>['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'division_id' => ['required'],
            'district_id' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        // dd($user);

        $userProfile = $user->user_profile()->create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'postcode' => $request->postcode,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
        ]);
        $to = 'rvr@arguss.lv';
        $subject = 'Hello';
        $message = 'This is a simple email sent from Laravel.';

        // Send the email
        // Mail::raw($message, function ($email) use ($to, $subject) {
        //     $email->to($to)
        //     ->subject($subject);
        // });

        event(new UserRegistered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
