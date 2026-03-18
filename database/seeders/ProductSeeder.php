<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Create or get categories
        $beverages   = Category::firstOrCreate(['name' => 'Beverages']);
        $snacks      = Category::firstOrCreate(['name' => 'Snacks']);
        $dairy       = Category::firstOrCreate(['name' => 'Dairy']);
        $bakery      = Category::firstOrCreate(['name' => 'Bakery']);
        $household   = Category::firstOrCreate(['name' => 'Household']);
        $electronics = Category::firstOrCreate(['name' => 'Electronics']);

        // 🔹 Create or get suppliers
        $indofood = Supplier::firstOrCreate([
            'name' => 'PT Indofood'
        ], [
            'phone' => '081234567890',
            'address' => 'Jakarta'
        ]);

        $nestle = Supplier::firstOrCreate([
            'name' => 'Nestlé Indonesia'
        ]);

        $abc = Supplier::firstOrCreate([
            'name' => 'ABC Foods'
        ]);

        $local = Supplier::firstOrCreate([
            'name' => 'Local Distributor Surabaya'
        ]);

        Product::insert([

            // 🥤 Beverages
            [
                'category_id' => $beverages->id,
                'supplier_id' => $local->id,
                'name' => 'Aqua Mineral Water 600ml',
                'cost_price' => 2000,
                'selling_price' => 3500,
                'stock' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => $beverages->id,
                'supplier_id' => $abc->id,
                'name' => 'Teh Botol Sosro',
                'cost_price' => 3000,
                'selling_price' => 4500,
                'stock' => 8, // ⚠️ Low
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 🍜 Snacks
            [
                'category_id' => $snacks->id,
                'supplier_id' => $indofood->id,
                'name' => 'Indomie Goreng',
                'cost_price' => 2200,
                'selling_price' => 3500,
                'stock' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 🥛 Dairy
            [
                'category_id' => $dairy->id,
                'supplier_id' => $nestle->id,
                'name' => 'Milk 1L',
                'cost_price' => 15000,
                'selling_price' => 19000,
                'stock' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 🍞 Bakery
            [
                'category_id' => $bakery->id,
                'supplier_id' => $local->id,
                'name' => 'Sari Roti Bread',
                'cost_price' => 9000,
                'selling_price' => 12000,
                'stock' => 6, // ⚠️ Low
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 🧼 Household
            [
                'category_id' => $household->id,
                'supplier_id' => $abc->id,
                'name' => 'Rinso Detergent 1kg',
                'cost_price' => 18000,
                'selling_price' => 23000,
                'stock' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 💻 Electronics
            [
                'category_id' => $electronics->id,
                'supplier_id' => $local->id,
                'name' => 'USB Charger Cable',
                'cost_price' => 10000,
                'selling_price' => 15000,
                'stock' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}