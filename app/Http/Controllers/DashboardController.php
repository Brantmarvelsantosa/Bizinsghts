<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Services\InsightService;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(InsightService $insightService)
    {
        $insights = $insightService->generateInsights();
        // 💰 Total Revenue (paid orders only)
        $totalRevenue = Order::where('status', 'paid')->sum('total');

        // 📈 Total Profit (from order items)
        $totalProfit = OrderItem::sum('profit');

        // 🧾 Total Orders
        $totalOrders = Order::count();

        // 👥 Total Customers
        $totalCustomers = Customer::count();

        // 📦 Low Stock Products
        $lowStockProducts = Product::where('stock', '<', 10)->get();

        // 📈 Monthly revenue trend
        $monthlyRevenue = Order::select(
            DB::raw('MONTH(order_date) as month'),
            DB::raw('SUM(total) as revenue')
        )
        ->where('status', 'paid')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // 🏆 Best-selling products
        $topProducts = OrderItem::select(
            'product_id',
            DB::raw('SUM(quantity) as total_sold')
        )
        ->groupBy('product_id')
        ->orderByDesc('total_sold')
        ->with('product')
        ->take(5)
        ->get();

        // Payment Method Distribution
        // This will show how many times each payment method is used
        $paymentMethods = Payment::select(
            'method',
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('method')
        ->get();

        return view('dashboard.index', compact(
            'totalRevenue',
            'totalProfit',
            'totalOrders',
            'totalCustomers',
            'lowStockProducts',
            'monthlyRevenue',
            'topProducts',
            'paymentMethods',
            'insights',
        ));
    }
}
