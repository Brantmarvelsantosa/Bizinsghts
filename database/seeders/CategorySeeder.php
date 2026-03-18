<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name' => 'Beverages'],
            ['name' => 'Snacks'],
            ['name' => 'Dairy'],
            ['name' => 'Bakery'],
            ['name' => 'Household'],
            ['name' => 'Electronics'],
        ]);
    }
}