<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function store(Request $request, Order $order)
    {
        DB::transaction(function () use ($order, $request) {

            // Create payment record
            Payment::create([
                'order_id' => $order->id,
                'method' => $request->method,
                'amount_paid' => $order->total,
                'payment_date' => now()
            ]);

            // Mark order as paid
            $order->update([
                'status' => 'paid'
            ]);
        });

        return redirect()->route('orders.index')
            ->with('success', 'Payment recorded successfully 💰');
    }
}
