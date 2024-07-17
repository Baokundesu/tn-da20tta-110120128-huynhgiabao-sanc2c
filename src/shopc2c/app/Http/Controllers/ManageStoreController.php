<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class ManageStoreController extends Controller
{
    public function index()
    {
        $stores = Store::where('user_id', auth()->id())->get();
        return view('manage.index', compact('stores'));
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('manage.edit', compact('store'));
    }

    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        // Validate request data
        $request->validate([
            'title' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'is_free' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string|max:255',
        ]);

        // Cập nhật thông tin gian hàng
        $store->title = $request->title;
        $store->product_name = $request->product_name;
        $store->address = $request->address;
        $store->is_free = $request->has('is_free') ? 1 : 0;
        $store->price = $request->has('is_free') ? 0 : $request->price;

        // Xử lý hình ảnh nếu có upload mới
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $store->image_url = 'images/' . $imageName;
        }

        $store->save();

        return redirect()->route('manage.stores.index')->with('success', 'Gian hàng đã được cập nhật thành công');
    }

    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
        return redirect()->route('manage.stores.index')->with('success', 'Gian hàng đã được xóa thành công');
    }
}
