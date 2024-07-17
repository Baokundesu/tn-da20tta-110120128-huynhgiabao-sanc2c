<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // Đăng nhập thành công
            return redirect()->intended(route('admin.dashboard'));
        }

        // Đăng nhập không thành công
        return redirect()->back()->withInput()->withErrors([
            'username' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}