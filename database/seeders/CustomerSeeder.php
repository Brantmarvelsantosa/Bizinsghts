<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::insert([

            [
                'name' => 'Budi Santoso',
                'phone' => '081234567890',
                'email' => 'budi@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Siti Aisyah',
                'phone' => '082345678901',
                'email' => 'siti@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Ahmad Wijaya',
                'phone' => '083456789012',
                'email' => 'ahmad@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Dewi Lestari',
                'phone' => '084567890123',
                'email' => 'dewi@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
