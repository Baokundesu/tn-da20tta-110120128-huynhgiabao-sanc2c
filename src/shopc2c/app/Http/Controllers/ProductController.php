<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(Product $product)
    {
        $this->cartService->addToCart($product);

        return redirect()->back()->with('success_message', 'Đã thêm sản phẩm vào giỏ hàng.');
    }

    public function removeFromCart($productId)
    {
        $this->cartService->removeItem($productId);

        return redirect()->back()->with('success_message', 'Đã xoá sản phẩm khỏi giỏ hàng.');
    }

    public function updateCart(Request $request, $productId)
    {
        $quantity = $request->input('quantity');

        $this->cartService->updateQuantity($productId, $quantity);

        return redirect()->back()->with('success_message', 'Đã cập nhật giỏ hàng.');
    }

    public function clearCart()
    {
        $this->cartService->clearCart();

        return redirect()->back()->with('success_message', 'Đã xoá toàn bộ giỏ hàng.');
    }
}
