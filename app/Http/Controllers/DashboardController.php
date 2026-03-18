<?php

namespace App\Http\Controllers;

use App\Models\Product;


class DashboardController extends Controller
{
    public function index()
    {
        $lowStockProducts = Product::where('stock', '<', 10)->get();

        return view('dashboard', compact('lowStockProducts'));
    }
}
