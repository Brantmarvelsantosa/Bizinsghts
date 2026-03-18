<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::insert([

            [
                'customer_id' => 1,
                'user_id' => 1,
                'order_date' => now(),
                'subtotal' => 50000,
                'tax' => 0,
                'discount' => 0,
                'total' => 50000,
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'customer_id' => 2,
                'user_id' => 1,
                'order_date' => now()->subDay(),
                'subtotal' => 75000,
                'tax' => 0,
                'discount' => 5000,
                'total' => 70000,
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'customer_id' => 3,
                'user_id' => 2,
                'order_date' => now()->subDays(2),
                'subtotal' => 120000,
                'tax' => 0,
                'discount' => 10000,
                'total' => 110000,
                'status' => 'unpaid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'customer_id' => 1,
                'user_id' => 2,
                'order_date' => now()->subDays(3),
                'subtotal' => 30000,
                'tax' => 0,
                'discount' => 0,
                'total' => 30000,
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'customer_id' => 4,
                'user_id' => 1,
                'order_date' => now()->subDays(4),
                'subtotal' => 98000,
                'tax' => 0,
                'discount' => 8000,
                'total' => 90000,
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'customer_id' => 2,
                'user_id' => 2,
                'order_date' => now()->subDays(5),
                'subtotal' => 45000,
                'tax' => 0,
                'discount' => 0,
                'total' => 45000,
                'status' => 'unpaid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'customer_id' => 3,
                'user_id' => 1,
                'order_date' => now()->subDays(6),
                'subtotal' => 67000,
                'tax' => 0,
                'discount' => 7000,
                'total' => 60000,
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'customer_id' => 4,
                'user_id' => 2,
                'order_date' => now()->subDays(7),
                'subtotal' => 150000,
                'tax' => 0,
                'discount' => 10000,
                'total' => 140000,
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'customer_id' => 1,
                'user_id' => 1,
                'order_date' => now()->subDays(8),
                'subtotal' => 82000,
                'tax' => 0,
                'discount' => 2000,
                'total' => 80000,
                'status' => 'unpaid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'customer_id' => 2,
                'user_id' => 2,
                'order_date' => now()->subDays(9),
                'subtotal' => 25000,
                'tax' => 0,
                'discount' => 0,
                'total' => 25000,
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
