<?php

namespace App\Services;

use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class InsightService
{
    public function generateInsights($data = [])
    {
        $insights = [];

        $revenue = $data['revenue'] ?? 0;
        $profit = $data['profit'] ?? 0;
        $orders = $data['orders'] ?? 0;
        $growth = $data['growth'] ?? 0;
        $lowStockCount = $data['low_stock'] ?? 0;

        // 🔹 1. Revenue Performance (Executive Level)
        if ($growth > 15) {
            $insights[] = "🚀 Strong growth: Revenue increased by " . round($growth, 1) . "%. Consider scaling marketing or inventory.";
        } elseif ($growth < -10) {
            $insights[] = "📉 Revenue dropped by " . round(abs($growth), 1) . "%. Investigate sales channels, pricing, or demand.";
        } else {
            $insights[] = "📊 Revenue is relatively stable. Monitor trends for opportunities.";
        }

        // 🔹 2. Profitability Insight
        if ($revenue > 0) {
            $margin = ($profit / $revenue) * 100;

            if ($margin < 20) {
                $insights[] = "⚠️ Low profit margin (" . round($margin, 1) . "%). Consider reducing costs or adjusting pricing.";
            } else {
                $insights[] = "💰 Healthy profit margin at " . round($margin, 1) . "%.";
            }
        }

        // 🔹 3. Low Stock + High Demand
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->pluck('product_id');

        $riskyProducts = Product::whereIn('id', $topProducts)
            ->where('stock', '<', 10)
            ->get();

        foreach ($riskyProducts as $product) {
            $insights[] = "⚠️ {$product->name} is high demand but low stock → restock immediately to avoid lost sales.";
        }

        if ($lowStockCount > 0) {
            $insights[] = "📦 {$lowStockCount} products are low in stock. Monitor inventory closely.";
        }

        // 🔹 4. Most Profitable Product (Improved)
        $topProfit = OrderItem::select('product_id', DB::raw('SUM(profit) as total_profit'))
            ->groupBy('product_id')
            ->orderByDesc('total_profit')
            ->with('product')
            ->first();

        if ($topProfit && $topProfit->product) {
            $insights[] = "🏆 {$topProfit->product->name} is your most profitable product → prioritize promotion and stock.";
        }

        // 🔹 5. Payment Behavior (Strategic)
        $topPayment = Payment::select('method', DB::raw('COUNT(*) as total'))
            ->groupBy('method')
            ->orderByDesc('total')
            ->first();

        if ($topPayment) {
            $insights[] = "💳 معظم customers prefer {$topPayment->method}. Optimize checkout experience for this method.";
        }

        // 🔹 6. Dead Stock (Actionable)
        $deadStock = Product::where('stock', '>', 50)
            ->whereNotIn('id', function ($query) {
                $query->select('product_id')->from('order_items');
            })
            ->get();

        foreach ($deadStock as $product) {
            $insights[] = "🐢 {$product->name} has high stock but no sales → apply discounts, bundles, or promotions.";
        }

        // 🔹 7. Sales Efficiency
        if ($orders > 0) {
            $avgOrder = $revenue / $orders;

            if ($avgOrder < 50000) {
                $insights[] = "🛒 Low average order value (Rp " . number_format($avgOrder) . "). Consider upselling or bundling.";
            } else {
                $insights[] = "🛍️ Strong average order value (Rp " . number_format($avgOrder) . ").";
            }
        }

        return $insights;
    }
}