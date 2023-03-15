<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Customers\Order;
use App\Models\Customers\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;




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
        $notification = array('message' => __('system.profile_updated', [], app()->getLocale()), 'alert-type' => 'success');
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
            $notification = array('message' => __('system.password_changed', [], app()->getLocale()), 'alert-type' => 'success');
            return redirect()->route('index')->with($notification);
        } else {
            $notification = array('message' => __('system.error', [], app()->getLocale()), 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    public function userOrders()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(5);
        return view('customers.profile.orders', compact('orders'));
    }

    public function OrderDetails($order_id)
    {
        $order = Order::where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('customers.profile.order_details', compact('order', 'orderItem'));
    }
    public function OrderInvoice($order_id)
    {
        $order = Order::with('division', 'district', 'state', 'user')
            ->where('id', $order_id)
            ->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')
            ->where('order_id', $order_id)
            ->orderBy('id', 'DESC')->get();
        $pdf = Pdf::loadView('customers.invoice.order_invoice', compact('order', 'orderItem'))
        ->setPaper('a4')
        ->setOptions(['tempDir' =>public_path(),
                      'chroot' =>public_path()]);
          return $pdf->download($order->invoice_no.'-'.Carbon::now()->format('Ymd').'.pdf');
        // return view('customers.invoice.order_invoice', compact('order', 'orderItem'));
    }
}
