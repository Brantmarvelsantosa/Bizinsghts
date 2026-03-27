<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Services\InsightService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request, InsightService $insightService)
    {
        // 🔹 1. FILTERS (IMPORTANT)
        $startDate = $request->start_date ?? now()->startOfMonth();
        $endDate   = $request->end_date ?? now();

        // Base query (reuse everywhere)
        $orderQuery = Order::whereBetween('order_date', [$startDate, $endDate]);

        // 💰 Total Revenue (paid only)
        $totalRevenue = (clone $orderQuery)
            ->where('status', 'paid')
            ->sum('total');

        // 📈 Total Profit
        $totalProfit = OrderItem::whereHas('order', function ($q) use ($startDate, $endDate) {
            $q->whereBetween('order_date', [$startDate, $endDate])
              ->where('status', 'paid');
        })->sum('profit');

        // 🧾 Total Orders
        $totalOrders = (clone $orderQuery)->count();

        // 👥 Total Customers
        $totalCustomers = Customer::count();

        // 📊 Advanced KPIs
        $aov = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
        $profitMargin = $totalRevenue > 0 ? ($totalProfit / $totalRevenue) * 100 : 0;

        // 📦 Low Stock
        $lowStockProducts = Product::where('stock', '<', 10)->get();

        // 📈 Daily Revenue (for chart)
        $dailyRevenue = (clone $orderQuery)
            ->selectRaw('DATE(order_date) as date, SUM(total) as revenue')
            ->where('status', 'paid')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // 📈 Monthly Revenue
        $monthlyRevenue = (clone $orderQuery)
            ->selectRaw('MONTH(order_date) as month, SUM(total) as revenue')
            ->where('status', 'paid')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // 🏆 Top Products
        $topProducts = OrderItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total_sold')
            )
            ->whereHas('order', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('order_date', [$startDate, $endDate])
                  ->where('status', 'paid');
            })
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with('product')
            ->take(5)
            ->get();

        // 💳 Payment Distribution
        $paymentMethods = Payment::select(
                'method',
                DB::raw('COUNT(*) as total')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('method')
            ->get();

        // 📈 Growth (compare with previous period)
        $previousRevenue = Order::whereBetween('order_date', [
                now()->parse($startDate)->subDays(
                    now()->parse($startDate)->diffInDays($endDate)
                ),
                $startDate
            ])
            ->where('status', 'paid')
            ->sum('total');

        $revenueGrowth = $previousRevenue > 0
            ? (($totalRevenue - $previousRevenue) / $previousRevenue) * 100
            : 0;

        // 🧠 AI Insights (pass extra data)
        $insights = $insightService->generateInsights([
            'revenue' => $totalRevenue,
            'profit' => $totalProfit,
            'orders' => $totalOrders,
            'growth' => $revenueGrowth,
            'low_stock' => $lowStockProducts->count()
        ]);

        return view('dashboard.index', compact(
            'totalRevenue',
            'totalProfit',
            'totalOrders',
            'totalCustomers',
            'lowStockProducts',
            'monthlyRevenue',
            'dailyRevenue',
            'topProducts',
            'paymentMethods',
            'insights',

            // 🔥 new metrics
            'aov',
            'profitMargin',
            'revenueGrowth',
            'startDate',
            'endDate'
        ));
    }
}