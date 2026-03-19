<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class InsightService
{
    public function generateInsights()
    {
        $insights = [];

        // 🔹 1. Low Stock Insight
        $lowStock = Product::where('stock', '<', 10)->count();

        if ($lowStock > 0) {
            $insights[] = "⚠️ {$lowStock} products are low in stock. Reorder recommended.";
        }

        // 🔹 2. Revenue Drop (Month-over-Month)
        $currentMonth = now()->month;
        $lastMonth = now()->subMonth()->month;

        $currentRevenue = Order::whereMonth('order_date', $currentMonth)
            ->where('status', 'paid')
            ->sum('total');

        $lastRevenue = Order::whereMonth('order_date', $lastMonth)
            ->where('status', 'paid')
            ->sum('total');

        if ($lastRevenue > 0) {
            $change = (($currentRevenue - $lastRevenue) / $lastRevenue) * 100;

            if ($change < -20) {
                $insights[] = "📉 Revenue dropped by " . round(abs($change), 2) . "% compared to last month.";
            }
        }

        // 🔹 3. Pareto Analysis (80/20 Rule)
        $totalRevenue = OrderItem::sum('subtotal');

        $topProducts = OrderItem::select(
                'product_id',
                DB::raw('SUM(subtotal) as revenue')
            )
            ->groupBy('product_id')
            ->orderByDesc('revenue')
            ->get();

        $runningRevenue = 0;
        $topCount = 0;

        foreach ($topProducts as $item) {
            $runningRevenue += $item->revenue;
            $topCount++;

            if ($runningRevenue >= 0.8 * $totalRevenue) {
                break;
            }
        }

        if ($totalRevenue > 0 && ($topCount / max(count($topProducts),1)) <= 0.2) {
            $insights[] = "📊 Top {$topCount} products generate ~80% of revenue. Focus on best-sellers.";
        }

        // 🔹 4. Repeat Customer Rate
        $totalCustomers = \App\Models\Customer::count();

        $repeatCustomers = Order::select('customer_id')
            ->groupBy('customer_id')
            ->havingRaw('COUNT(*) > 1')
            ->get()
            ->count();

        if ($totalCustomers > 0) {
            $rate = ($repeatCustomers / $totalCustomers) * 100;

            if ($rate < 30) {
                $insights[] = "👥 Repeat customer rate is low (" . round($rate, 1) . "%). Consider loyalty programs.";
            }
        }

        return $insights;
    }
}