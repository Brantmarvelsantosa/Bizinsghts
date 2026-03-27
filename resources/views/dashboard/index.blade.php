<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            📊 Business Analytics Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- 🔹 FILTERS -->
            <form method="GET" class="flex flex-wrap gap-3 bg-white p-4 rounded-xl shadow">
                <input type="date" name="start_date" value="{{ $startDate }}" class="border rounded px-3 py-2">
                <input type="date" name="end_date" value="{{ $endDate }}" class="border rounded px-3 py-2">

                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Apply Filter
                </button>
            </form>

            <!-- 🔹 KPI CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white p-5 rounded-2xl shadow">
                    <p class="text-sm text-gray-500">Total Revenue</p>
                    <h3 class="text-2xl font-bold text-green-600">
                        Rp {{ number_format($totalRevenue) }}
                    </h3>
                    <p class="text-sm mt-1 {{ $revenueGrowth >= 0 ? 'text-green-500' : 'text-red-500' }}">
                        {{ number_format($revenueGrowth, 2) }}%
                    </p>
                </div>

                <div class="bg-white p-5 rounded-2xl shadow">
                    <p class="text-sm text-gray-500">Total Profit</p>
                    <h3 class="text-2xl font-bold text-blue-600">
                        Rp {{ number_format($totalProfit) }}
                    </h3>
                    <p class="text-sm text-gray-500">
                        Margin: {{ number_format($profitMargin, 2) }}%
                    </p>
                </div>

                <div class="bg-white p-5 rounded-2xl shadow">
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <h3 class="text-2xl font-bold">
                        {{ $totalOrders }}
                    </h3>
                    <p class="text-sm text-gray-500">
                        AOV: Rp {{ number_format($aov) }}
                    </p>
                </div>

                <div class="bg-white p-5 rounded-2xl shadow">
                    <p class="text-sm text-gray-500">Customers</p>
                    <h3 class="text-2xl font-bold">
                        {{ $totalCustomers }}
                    </h3>
                </div>

            </div>

            <!-- 🔹 CHART + TOP PRODUCTS -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Chart -->
                <div class="bg-white p-6 rounded-2xl shadow">
                    <h2 class="text-lg font-semibold mb-4">📈 Revenue Trend</h2>
                    <canvas id="revenueChart"></canvas>
                </div>

                <!-- Top Products -->
                <div class="bg-white p-6 rounded-2xl shadow">
                    <h2 class="text-lg font-semibold mb-4">🏆 Top Selling Products</h2>

                    <div class="space-y-2">
                        @foreach($topProducts as $item)
                            <div class="flex justify-between border-b pb-2">
                                <span>{{ $item->product->name ?? 'Unknown' }}</span>
                                <span class="font-bold">{{ $item->total_sold }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- 🔹 ALERTS + PAYMENTS -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Low Stock -->
                <div class="bg-white p-6 rounded-2xl shadow">
                    <h2 class="text-lg font-semibold text-red-600 mb-4">⚠️ Low Stock Alerts</h2>

                    @forelse($lowStockProducts as $product)
                        <div class="flex justify-between border-b pb-2">
                            <span>{{ $product->name }}</span>
                            <span class="text-red-600 font-bold">
                                {{ $product->stock }}
                            </span>
                        </div>
                    @empty
                        <p class="text-green-600">All products are well stocked ✅</p>
                    @endforelse
                </div>

                <!-- Payment Methods -->
                <div class="bg-white p-6 rounded-2xl shadow">
                    <h2 class="text-lg font-semibold mb-4">💳 Payment Distribution</h2>

                    @foreach($paymentMethods as $pm)
                        <div class="flex justify-between border-b pb-2">
                            <span>{{ ucfirst($pm->method) }}</span>
                            <span class="font-bold">{{ $pm->total }}</span>
                        </div>
                    @endforeach
                </div>

            </div>

            <!-- 🔹 INSIGHTS -->
            <div class="bg-yellow-50 border border-yellow-200 p-6 rounded-2xl">
                <h2 class="text-lg font-semibold mb-3">🧠 AI Business Insights</h2>

                @if(count($insights) > 0)
                    <ul class="list-disc pl-5 space-y-2">
                        @foreach($insights as $insight)
                            <li class="leading-relaxed">{{ $insight }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No insights available yet.</p>
                @endif
            </div>

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const data = @json($dailyRevenue);

        const labels = data.map(item => item.date);
        const values = data.map(item => item.revenue);

        new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue',
                    data: values,
                    borderWidth: 2,
                    tension: 0.3
                }]
            }
        });
    </script>

</x-app-layout>