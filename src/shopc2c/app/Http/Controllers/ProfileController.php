<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Store;
use App\Models\Order;

class ProfileController extends Controller
{
    /**
     * Hiển thị thông tin hồ sơ của người dùng.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        $stores = Store::where('user_id', $user->id)->get(); // Lấy danh sách các gian hàng của người dùng
        $pendingOrders = Order::where('user_id', $user->id)
                              ->where('status', 'pending')
                              ->with('items')
                              ->paginate(1); // Lấy các đơn hàng chờ xác nhận

        return view('profile.show', [
            'user' => $user,
            'stores' => $stores, // Truyền danh sách các gian hàng tới view
            'pendingOrders' => $pendingOrders, // Truyền danh sách các đơn hàng chờ xác nhận tới view
        ]);
    }

    /**
     * Cập nhật thông tin hồ sơ của người dùng.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('profile.show')->with('status', 'Thông tin hồ sơ đã được cập nhật thành công.');
    }

    /**
     * Cập nhật mật khẩu của người dùng.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác.'])->withInput();
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('profile.show')->with('status', 'Mật khẩu đã được cập nhật thành công.');
    }
}
