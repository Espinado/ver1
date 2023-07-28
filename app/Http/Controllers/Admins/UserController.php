<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function AllUsersView() {
        $users=User::all();

        return view('admin.users.users_view', compact('users'));
    }
}
