<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Optional Tailwind (if you use it) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <h1 class="text-2xl font-bold mb-6">📊 Business Dashboard</h1>

    <!-- 🔹 KPI CARDS -->
    <div class="grid grid-cols-4 gap-4 mb-8">

        <div class="p-4 bg-white shadow rounded">
            <h3 class="text-gray-500">Total Revenue</h3>
            <p class="text-xl font-bold">Rp {{ number_format($totalRevenue) }}</p>
        </div>

        <div class="p-4 bg-white shadow rounded">
            <h3 class="text-gray-500">Total Profit</h3>
            <p class="text-xl font-bold">Rp {{ number_format($totalProfit) }}</p>
        </div>

        <div class="p-4 bg-white shadow rounded">
            <h3 class="text-gray-500">Total Orders</h3>
            <p class="text-xl font-bold">{{ $totalOrders }}</p>
        </div>

        <div class="p-4 bg-white shadow rounded">
            <h3 class="text-gray-500">Customers</h3>
            <p class="text-xl font-bold">{{ $totalCustomers }}</p>
        </div>

    </div>

    <!-- 🔹 MONTHLY REVENUE CHART -->
    <div class="bg-white p-6 shadow rounded mb-8">
        <h2 class="text-lg font-bold mb-4">📈 Monthly Revenue</h2>
        <canvas id="revenueChart"></canvas>
    </div>

    <!-- 🔹 TOP PRODUCTS -->
    <div class="bg-white p-6 shadow rounded mb-8">
        <h2 class="text-lg font-bold mb-4">🏆 Top Products</h2>

        @foreach($topProducts as $item)
            <p>
                {{ $item->product->name ?? 'Unknown' }}
                — Sold: {{ $item->total_sold }}
            </p>
        @endforeach
    </div>

    <!-- 🔹 LOW STOCK -->
    <div class="bg-white p-6 shadow rounded mb-8">
        <h2 class="text-lg font-bold mb-4 text-red-600">⚠️ Low Stock Alert</h2>

        @forelse($lowStockProducts as $product)
            <p>
                {{ $product->name }} — Stock: {{ $product->stock }}
            </p>
        @empty
            <p class="text-green-600">All products are well stocked ✅</p>
        @endforelse
    </div>

    <!-- 🔹 PAYMENT METHODS -->
    <div class="bg-white p-6 shadow rounded mb-8">
        <h2 class="text-lg font-bold mb-4">💳 Payment Methods</h2>

        @foreach($paymentMethods as $pm)
            <p>{{ $pm->method }} — {{ $pm->total }}</p>
        @endforeach
    </div>

    <!-- 🔹 CHART SCRIPT -->
    <script>
        const data = @json($monthlyRevenue);

        const labels = data.map(item => "Month " + item.month);
        const values = data.map(item => item.revenue);

        new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Monthly Revenue',
                    data: values,
                    borderWidth: 2
                }]
            }
        });
    </script>

</body>
</html>