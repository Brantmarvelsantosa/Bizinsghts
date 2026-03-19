<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📦 Product List
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ➕ ADD PRODUCT BUTTON --}}
            <a href="{{ route('products.create') }}"
               style="
                   display:inline-block;
                   margin-bottom:15px;
                   padding:8px 12px;
                   background:#4CAF50;
                   color:white;
                   text-decoration:none;
                   border-radius:4px;
                   font-weight:bold;
               ">
                ➕ Add Product
            </a>

            {{-- 🔴 GLOBAL LOW STOCK ALERT --}}
            @php
                $lowStockProducts = $products->where('stock', '<', 10);
            @endphp

            @if($lowStockProducts->count() > 0)
                <div style="
                    background:#ffe5e5;
                    border:1px solid #ff9999;
                    padding:15px;
                    margin-bottom:20px;
                    border-radius:6px;
                    color:#b30000;
                    font-weight:bold;
                ">
                    ⚠️ Warning: {{ $lowStockProducts->count() }} product(s) are low in stock (below 10)

                    <ul style="margin-top:10px;">
                        @foreach($lowStockProducts as $p)
                            <li>{{ $p->name }} — Stock: {{ $p->stock }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg p-6">

                <table border="1" cellpadding="10" cellspacing="0" width="100%">
                    <thead style="background:#f3f4f6;">
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Supplier</th>
                            <th>Cost Price</th>
                            <th>Selling Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($products as $product)

                        <tr @if($product->stock < 10) style="background:#fff0f0;" @endif>

                            <td>{{ $product->name }}</td>

                            <td>{{ $product->category->name ?? '-' }}</td>

                            <td>{{ $product->supplier->name ?? '-' }}</td>

                            <td>Rp {{ number_format($product->cost_price) }}</td>

                            <td>Rp {{ number_format($product->selling_price) }}</td>

                            <td>{{ $product->stock }}</td>

                            <td>
                                @if($product->stock < 10)
                                    <span style="color:red; font-weight:bold;">
                                        ⚠️ Low
                                    </span>
                                @else
                                    <span style="color:green; font-weight:bold;">
                                        ✔️ OK
                                    </span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('products.edit', $product->id) }}">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}"
                                      method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('Delete this product?')">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </td>

                        </tr>

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>