<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::insert([
            [
                'name' => 'PT Indofood',
                'phone' => '081234567890',
                'address' => 'Jakarta, Indonesia'
            ],
            [
                'name' => 'Nestlé Indonesia',
                'phone' => '082345678901',
                'address' => 'Jakarta, Indonesia'
            ],
            [
                'name' => 'ABC Foods',
                'phone' => '083456789012',
                'address' => 'Bandung, Indonesia'
            ],
            [
                'name' => 'Local Distributor Surabaya',
                'phone' => '084567890123',
                'address' => 'Surabaya, Indonesia'
            ],
        ]);
    }
}