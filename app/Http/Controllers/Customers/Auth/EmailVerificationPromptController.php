<?php

namespace App\Http\Controllers\Customers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Swift_TransportException;
use Illuminate\Support\Facades\Log;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        try {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : view('auth.verify-email');
        } catch (Swift_TransportException $e) {
            // Handle the exception here
            if ($e->getCode() === 550) {
                return redirect()->back()->with('error', 'Invalid email address.');
            } else {
                // Log the error and display a generic error message
                Log::error($e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while sending the email.');
            }

    }
}
