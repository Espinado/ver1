<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admins\Admin;
use Facade\Ignition\Context\LaravelConsoleContext;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use LaravelLocalization;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Interfaces\AdminRepositoryInterface;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    private AdminRepositoryInterface $AdminRepository;

    public function __construct(AdminRepositoryInterface $AdminRepository)
    {
        $this->AdminRepository = $AdminRepository;
        $this->middleware('admin', ['except' => ['Index', 'Login']]);
    }


    public function Index()
    {
        return view('admin.auth.login');
    }

    public function Dashboard()
    {
        return view('admin.index');
    }

    public function Login(Request $request)
    {

        $check = $request->all();
        $notification = array('message' => 'Loged in', 'alert-type' => 'success');
        if (Auth::guard('admin')->attempt([
            'email'    => $check['email'],
            'password' => $check['password']
        ])) {
            return redirect()->route('admin.dashboard')->with($notification);
        } else {
            return back()->with('error', 'Login failed');
        }
    }

    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('success', 'Logged Out');
    }

    public function AdminRegister()
    {

        return view('admin.auth.admin_register');
    }

    public function AdminRegisterCreate(Request $request)
    {

        Admin::insert([
            'name'       =>   $request->name,
            'email'      =>   $request->email,
            'password'   =>   Hash::make($request->password),
            'created_at' =>   Carbon::now()
        ]);
        return redirect()->route('login_form')->with('success', 'Registered');
    }

    public function adminList()
    {
        $adminList = $this->AdminRepository->getAllAdmins();
        return view('admin.admins.index', compact('adminList'));
    }


}
