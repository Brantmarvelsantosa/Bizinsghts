<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payments')->insert([

            [
                'order_id' => 1,
                'method' => 'cash',
                'amount_paid' => 50000,
                'payment_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'order_id' => 2,
                'method' => 'transfer',
                'amount_paid' => 70000,
                'payment_date' => now()->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // order_id 3 is unpaid → no payment

            [
                'order_id' => 4,
                'method' => 'e-wallet',
                'amount_paid' => 30000,
                'payment_date' => now()->subDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'order_id' => 5,
                'method' => 'transfer',
                'amount_paid' => 90000,
                'payment_date' => now()->subDays(4),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // order_id 6 is unpaid → no payment

            [
                'order_id' => 7,
                'method' => 'cash',
                'amount_paid' => 60000,
                'payment_date' => now()->subDays(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'order_id' => 8,
                'method' => 'e-wallet',
                'amount_paid' => 140000,
                'payment_date' => now()->subDays(7),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // order_id 9 is unpaid → no payment

            [
                'order_id' => 10,
                'method' => 'cash',
                'amount_paid' => 25000,
                'payment_date' => now()->subDays(9),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}