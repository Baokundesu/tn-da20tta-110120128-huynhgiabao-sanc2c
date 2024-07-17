<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;
    protected $keyType = 'int';

    protected $fillable = ['user_id', 'store_id', 'product_name', 'price', 'quantity'];

    protected static function boot()
    {
        parent::boot();

        // Xác định sự kiện saving để ngăn việc tự động tăng ID khi lưu
        static::saving(function ($model) {
            $model->incrementing = false;
        });
    }

    public function getKeyName()
    {
        return null; // Eloquent mong đợi một khóa chính duy nhất, do đó chúng tôi trả về null
    }

    public function setKeysForSaveQuery($query)
    {
        $query->where('user_id', $this->getAttribute('user_id'))
              ->where('store_id', $this->getAttribute('store_id'));

        return $query;
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
