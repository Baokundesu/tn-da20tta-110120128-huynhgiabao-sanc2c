<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;

class StoreController extends Controller
{
    public function create()
    {
        return view('store.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
            'origin' => 'nullable|string',
            'is_free' => 'boolean',
            'price' => 'nullable|numeric',
            'unit' => 'required|string',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'product_name' => 'required|string|max:255',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Store::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'origin' => $request->input('origin'),
            'is_free' => $request->input('is_free') ? true : false,
            'price' => $request->input('is_free') ? null : $request->input('price'),
            'unit' => $request->input('unit'),
            'address' => $request->input('address'),
            'image_url' => $imagePath ? 'storage/' . $imagePath : null, 
            'status' => 'pending',
            'product_name' => $request->input('product_name'),
        ]);

        return redirect()->route('home')->with('status', 'Gian hàng đã được đăng ký thành công và đang chờ phê duyệt.');
    }

    public function index(Request $request, $type = null)
    {
        if ($type === null || $type === 'all') {
            $stores = Store::where('status', 'approved')->paginate(8);
        } else {
            $stores = Store::where('status', 'approved')
                            ->where('type', $type)
                            ->paginate(8);
        }

        return view('store.index', compact('stores'));
    }

    public function show($id)
    {
        $store = Store::where('id', $id)->where('status', 'approved')->firstOrFail(); // Chỉ hiển thị các gian hàng đã được duyệt
        return view('store.show', compact('store'));
    }

    public function filterByType($type)
    {
        $stores = Store::where('status', 'approved')
                        ->where('type', $type)
                        ->get();

        return view('store.index', compact('stores'));
    }
}
