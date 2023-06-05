<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers\Subscriber;

class SubscribeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);
        $subscriber=new Subscriber();
        $subscriber->email=$request->email;
        $subscriber->save();
        $notification = array('message' => 'You have been subscribed', 'alert-type' => 'success');
        return redirect()->route('index')->with($notification);
    }
}
