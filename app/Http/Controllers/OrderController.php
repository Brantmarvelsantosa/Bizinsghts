<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\InventoryLog;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['customer','payment'])
        ->latest()
        ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $customers = Customer::all();

        return view('orders.create', compact('products','customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction(); //Start database transaction

        try {
            $subtotal = 0; // Set the subtotal to start from 0

            //Create order record (Temporary)
            $order = Order::create([
                'customer_id' => $request->customer_id,
                'user_id' => Auth::id(),
                'order_date' => now(),
                'subtotal' => 0,
                'tax' => 0,
                'discount' => 0,
                'total' => 0,
                'status' => 'unpaid'
            ]);
            // Temporary is zeros because totals will depend on items, which we haven't processed yet

            // Loop through selected products
            foreach ($request->products as $item) {

                // Get product info, if product doesn't exist, transaction rolls back
                $product = Product::findOrFail($item['product_id']);

                // Calculate Item Values
                $itemSubtotal = $product->selling_price * $item['quantity'];
                $profit = ($product->selling_price - $product->cost_price) * $item['quantity'];

                // Add to order subtotal
                $subtotal += $itemSubtotal;

                // Save order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->selling_price,
                    'cost_price' => $product->cost_price,
                    'subtotal' => $itemSubtotal,
                    'profit' => $profit
                ]);

                // Deduct stock 📉
                // Prevent Overselling
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stock not enough for {$product->name}");
                }

                // Create Inventory log
                InventoryLog::create([
                    'product_id' => $product->id,
                    'type' => 'OUT',
                    'quantity' => $item['quantity'],
                    'reference' => 'Order #' . $order->id
                ]);
        }

        // Update Final total calculation
        $tax = 0;
        $discount = 0;
        $total = $subtotal + $tax - $discount;

        // Update order with real totals
        $order->update([
            'subtotal' => $subtotal,
            'tax' => $tax,
            'discount' => $discount,
            'total' => $total
        ]);

        // Commit transaction
        DB::commit();

        return redirect()->route('orders.index');

    // Error handling
    } catch (\Exception $e) {

        DB::rollBack();
        return back()->withErrors($e->getMessage());
    }
}


    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
