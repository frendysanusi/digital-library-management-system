<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register() {
        return view('register');
    }

    public function login() {
        return view('login');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $data = $request->except('confirm_password', 'password');
        $data['password'] = bcrypt($request->password);
        User::create($data);
        return redirect('/books');
    }

    public function authenticate(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('username', 'password');


        $token = Auth::attempt($credentials);
        if ($token) {
            return redirect('/books');
        }

        return redirect('/login')->with('error', 'Username/Password is incorrect.');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
