<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Store extends Model
{
    protected $fillable = [
        'type', 'origin', 'is_free', 'price', 'unit', 'address', 'image_url', 'title', 'description', 'user_id', 'status', 'quantity', 'product_name'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($store) {
            // Xóa các sản phẩm trong giỏ hàng khi gian hàng bị xóa
            $store->cartItems()->delete();
        });

        static::creating(function ($store) {
            $store->user_id = Auth::id();
        });

        static::retrieved(function ($store) {
            switch ($store->unit) {
                case 'kg':
                    $store->unit = 'Kilogram (kg)';
                    break;
                case 'trai':
                    $store->unit = 'Trái';
                    break;
                case 'cu':
                    $store->unit = 'Củ';
                    break;
                case 'chuc':
                    $store->unit = 'Chục';
                    break;
                default:
                    break;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isFree()
    {
        return $this->is_free == 1;
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }
}
