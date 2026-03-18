<h1>🧾 Orders</h1>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <thead style="background:#f3f4f6;">
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Total</th>
            <th>Status</th>
            <th>Payment Method</th>
            <th>Details</th>
        </tr>
    </thead>

    <tbody>
    @foreach($orders as $order)
        <tr>

            <td>#{{ $order->id }}</td>

            <td>{{ $order->customer->name ?? '-' }}</td>

            <td>{{ $order->order_date }}</td>

            <td>Rp {{ number_format($order->total) }}</td>

            {{-- STATUS --}}
            <td>
                @if($order->status === 'paid')
                    <span style="color:green; font-weight:bold;">
                        ✔️ Paid
                    </span>
                @else
                    <span style="color:red; font-weight:bold;">
                        ❌ Unpaid
                    </span>
                @endif
            </td>

            {{-- PAYMENT METHOD --}}
            <td>
                {{ $order->payment->method ?? '-' }}
            </td>

            {{-- VIEW DETAILS --}}
            <td>
                <a href="{{ route('orders.show', $order->id) }}">
                    🔍 View
                </a>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>