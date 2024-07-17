<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;

class OrderController extends Controller
{
    public function index()
    {
        $pendingOrders = Order::where('user_id', $user->id())
                              ->where('status', 'pending')
                              ->with('items')
                              ->paginate(1);

        return view('profile.show', compact('pendingOrders'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng trống.');
        }

        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'store_id' => $item->store_id,
                'product_name' => $item->product_name,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('profile.show')->with('success', 'Đơn hàng đã được đặt và chờ xác nhận.');
    }

    public function userCancel(Request $request, $id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $order->delete();

        return redirect()->route('profile.show')->with('success', 'Đơn hàng đã được hủy.');
    }
}