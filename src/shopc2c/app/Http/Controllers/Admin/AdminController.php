<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Giả sử tài khoản admin được lưu trong bảng admin_users
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->withErrors('Login failed');
    }

    // Xử lý đăng xuất
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    // Trang dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Quản lý người dùng
    public function listUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        User::destroy($id);
        return redirect()->route('admin.users');
    }

    public function listStores()
    {
        $stores = Store::all();
        return view('admin.stores', compact('stores'));
    }

    public function deleteStore($id)
    {
        Store::destroy($id);
        return redirect()->route('admin.stores');
    }

    // Duyệt bài đăng
    public function pendingStores()
    {
        $stores = Store::where('status', 'pending')->get();
        return view('admin.pending_stores', compact('stores'));
    }

    public function approveStore($id)
    {
        $store = Store::find($id);
        $store->status = 'approved';
        $store->save();
        return redirect()->route('admin.stores.pending');
    }
}
