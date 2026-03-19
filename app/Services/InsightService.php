<?php

namespace App\Services;

use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class InsightService
{
    public function generateInsights()
    {
        $insights = [];

        // 🔹 1. Low Stock + High Demand (IMPORTANT)
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->pluck('product_id');

        $riskyProducts = Product::whereIn('id', $topProducts)
            ->where('stock', '<', 10)
            ->get();

        foreach ($riskyProducts as $product) {
            $insights[] = "⚠️ {$product->name} is low in stock AND high in demand → restock immediately.";
        }

        // 🔹 2. Revenue Trend (Last 7 Days)
        $last7 = DB::table('orders')
            ->where('status', 'paid')
            ->where('order_date', '>=', now()->subDays(7))
            ->sum('total');

        $prev7 = DB::table('orders')
            ->where('status', 'paid')
            ->whereBetween('order_date', [now()->subDays(14), now()->subDays(7)])
            ->sum('total');

        if ($prev7 > 0) {
            $change = (($last7 - $prev7) / $prev7) * 100;

            if ($change > 10) {
                $insights[] = "📈 Revenue increased by " . round($change, 1) . "% in the last 7 days.";
            } elseif ($change < -10) {
                $insights[] = "📉 Revenue dropped by " . round(abs($change), 1) . "% → investigate sales performance.";
            }
        }

        // 🔹 3. Most Profitable Product
        $topProfit = OrderItem::select('product_id', DB::raw('SUM(profit) as total_profit'))
            ->groupBy('product_id')
            ->orderByDesc('total_profit')
            ->first();

        if ($topProfit) {
            $insights[] = "💰 Most profitable product ID {$topProfit->product_id} → consider promoting it.";
        }

        // 🔹 4. Payment Behavior
        $topPayment = Payment::select('method', DB::raw('COUNT(*) as total'))
            ->groupBy('method')
            ->orderByDesc('total')
            ->first();

        if ($topPayment) {
            $insights[] = "💳 Most used payment method: {$topPayment->method}. Optimize this channel.";
        }

        // 🔹 5. Dead Stock (Very important in business)
        $deadStock = Product::where('stock', '>', 50)
            ->whereNotIn('id', function ($query) {
                $query->select('product_id')->from('order_items');
            })
            ->get();

        foreach ($deadStock as $product) {
            $insights[] = "🐢 {$product->name} has high stock but no sales → consider discount or promotion.";
        }

        return $insights;
    }
}