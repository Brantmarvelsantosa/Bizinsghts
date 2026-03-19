<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_items')->insert([

            // Order 1 (50000)
            [
                'order_id' => 1,
                'product_id' => 3, // Indomie
                'quantity' => 10,
                'price' => 3500,
                'cost_price' => 2200,
                'subtotal' => 35000,
                'profit' => 13000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'product_id' => 1, // Aqua
                'quantity' => 5,
                'price' => 3500,
                'cost_price' => 2000,
                'subtotal' => 17500,
                'profit' => 7500,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Order 2 (70000)
            [
                'order_id' => 2,
                'product_id' => 4, // Milk
                'quantity' => 3,
                'price' => 19000,
                'cost_price' => 15000,
                'subtotal' => 57000,
                'profit' => 12000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'product_id' => 2, // Teh Botol
                'quantity' => 3,
                'price' => 4500,
                'cost_price' => 3000,
                'subtotal' => 13500,
                'profit' => 4500,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Order 3 (120000 unpaid)
            [
                'order_id' => 3,
                'product_id' => 6, // Rinso
                'quantity' => 5,
                'price' => 23000,
                'cost_price' => 18000,
                'subtotal' => 115000,
                'profit' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Order 4 (30000)
            [
                'order_id' => 4,
                'product_id' => 5, // Bread
                'quantity' => 2,
                'price' => 12000,
                'cost_price' => 9000,
                'subtotal' => 24000,
                'profit' => 6000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Order 5 (90000)
            [
                'order_id' => 5,
                'product_id' => 6, // Rinso
                'quantity' => 3,
                'price' => 23000,
                'cost_price' => 18000,
                'subtotal' => 69000,
                'profit' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Order 6 (45000 unpaid)
            [
                'order_id' => 6,
                'product_id' => 7, // USB
                'quantity' => 3,
                'price' => 15000,
                'cost_price' => 10000,
                'subtotal' => 45000,
                'profit' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Order 7 (60000)
            [
                'order_id' => 7,
                'product_id' => 4, // Milk
                'quantity' => 3,
                'price' => 19000,
                'cost_price' => 15000,
                'subtotal' => 57000,
                'profit' => 12000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Order 8 (140000)
            [
                'order_id' => 8,
                'product_id' => 6, // Rinso
                'quantity' => 6,
                'price' => 23000,
                'cost_price' => 18000,
                'subtotal' => 138000,
                'profit' => 30000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Order 9 (80000 unpaid)
            [
                'order_id' => 9,
                'product_id' => 3, // Indomie
                'quantity' => 20,
                'price' => 3500,
                'cost_price' => 2200,
                'subtotal' => 70000,
                'profit' => 26000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Order 10 (25000)
            [
                'order_id' => 10,
                'product_id' => 7, // USB
                'quantity' => 1,
                'price' => 15000,
                'cost_price' => 10000,
                'subtotal' => 15000,
                'profit' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}