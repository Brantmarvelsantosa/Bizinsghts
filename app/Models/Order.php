<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // One order Belongs to one Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Order handled by one system user (staff/admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // One order contains many Products
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // One order has one payment record
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
