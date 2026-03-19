<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Edit Product
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                {{-- 🔙 BACK --}}
                <a href="{{ route('products.index') }}"
                   class="text-blue-600 hover:underline mb-4 inline-block">
                    ← Back to Products
                </a>

                {{-- 🔴 ERRORS --}}
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- 📝 FORM --}}
                <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- NAME --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="name"
                               class="w-full border rounded-lg p-2 mt-1"
                               value="{{ old('name', $product->name) }}" required>
                    </div>

                    {{-- CATEGORY --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" class="w-full border rounded-lg p-2 mt-1" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SUPPLIER --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Supplier</label>
                        <select name="supplier_id" class="w-full border rounded-lg p-2 mt-1" required>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- COST PRICE --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Cost Price</label>
                        <input type="number" name="cost_price"
                               class="w-full border rounded-lg p-2 mt-1"
                               value="{{ old('cost_price', $product->cost_price) }}" required>
                    </div>

                    {{-- SELLING PRICE --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Selling Price</label>
                        <input type="number" name="selling_price"
                               class="w-full border rounded-lg p-2 mt-1"
                               value="{{ old('selling_price', $product->selling_price) }}" required>
                    </div>

                    {{-- STOCK --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Stock</label>
                        <input type="number" name="stock"
                               class="w-full border rounded-lg p-2 mt-1"
                               value="{{ old('stock', $product->stock) }}" required>
                    </div>

                    {{-- SUBMIT --}}
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        💾 Update Product
                    </button>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>