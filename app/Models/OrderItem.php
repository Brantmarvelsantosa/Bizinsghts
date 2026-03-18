<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Each item belongs to one Order
    public function order()
    {
        return $this ->belongsTo(Order::class);
    }

    // Each item refers to one Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
