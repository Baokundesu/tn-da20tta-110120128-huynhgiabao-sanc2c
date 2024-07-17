<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartService extends Controller
{
    public function addToCart(Product $product)
    {
        $this->cart = session()->get('cart', []);
    
        $productId = $product->id;
    
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
        } else {
            $this->cart[$productId] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }
    
        $this->saveCart();
    }
    
}
