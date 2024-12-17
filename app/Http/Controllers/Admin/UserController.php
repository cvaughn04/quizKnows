<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::latest()->get();

        return $users;
    }

    public function insert(Request $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'admin' => $request->admin,
        ]);

        return response()->json($user);
    }

    public function deleteByEmail(Request $request) {
        $user = User::where([
            'email' => $request->email,
        ]);
        if ($user) {
            $user->delete();
            return true;
        } else {
            return false;
        }

    }
}
