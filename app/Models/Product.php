<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // A product belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A product comes from one supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // One product has many inventory records
    public function inventoryLogs()
    {
        return $this->hasMany(InventoryLog::class);
    }

    protected $fillable = [
    'category_id',
    'supplier_id',
    'name',
    'cost_price',
    'selling_price',
    'stock'
    ];
}
