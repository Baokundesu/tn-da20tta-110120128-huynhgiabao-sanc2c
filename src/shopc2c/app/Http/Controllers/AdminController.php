<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Store;

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

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->withErrors('Login failed');
    }

    // Xử lý đăng xuất
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.dashboard');
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

    // Quản lý gian hàng
    public function listStores()
    {
        $stores = Store::where('status', 'approved')->get();
        return view('admin.stores', compact('stores'));
    }

    public function deleteStore($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
        return redirect()->route('admin.stores')->with('success', 'Store deleted successfully');
    }

    // Duyệt gian hàng
    public function pendingStores()
    {
        $stores = Store::where('status', 'pending')->get();
        return view('admin.pending_stores', compact('stores'));
    }

    public function approveStore($id)
    {
        $store = Store::findOrFail($id);
        $store->status = 'approved';
        $store->save();
        return redirect()->route('admin.stores.pending')->with('success', 'Store approved successfully');
    }
}
