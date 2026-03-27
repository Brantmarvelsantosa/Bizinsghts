<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            ➕ Add New Product
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-2xl shadow">

                {{-- 🔙 BACK --}}
                <a href="{{ route('products.index') }}"
                   class="text-blue-600 hover:underline mb-4 inline-block">
                    ← Back to Products
                </a>

                {{-- ✅ SUCCESS MESSAGE --}}
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- 🔴 VALIDATION ERRORS --}}
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
                <form action="{{ route('products.store') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- NAME --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Product Name
                        </label>
                        <input type="text" name="name"
                               value="{{ old('name') }}"
                               class="w-full border rounded-lg px-3 py-2 mt-1"
                               placeholder="Enter product name"
                               required>
                    </div>

                    {{-- CATEGORY --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Category
                        </label>

                        <div class="flex gap-2 mt-1">
                            <select name="category_id"
                                    class="w-full border rounded-lg px-3 py-2"
                                    required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- 🔹 ADD NEW CATEGORY BUTTON --}}
                            <a href="{{ route('categories.create') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 whitespace-nowrap">
                                ➕ Add Category
                            </a>
                        </div>
                    </div>

                    {{-- SUPPLIER --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Supplier
                        </label>

                        <div class="flex gap-2 mt-1">
                            <select name="supplier_id"
                                    class="w-full border rounded-lg px-3 py-2"
                                    required>
                                <option value="">-- Select Supplier --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- 🔹 ADD NEW SUPPLIER BUTTON --}}
                            <a href="{{ route('suppliers.create') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 whitespace-nowrap">
                                ➕ Add Supplier
                            </a>
                        </div>
                    </div>

                    {{-- COST PRICE --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Cost Price
                        </label>
                        <input type="number" name="cost_price"
                               value="{{ old('cost_price') }}"
                               class="w-full border rounded-lg px-3 py-2 mt-1"
                               placeholder="e.g. 10000"
                               required>
                    </div>

                    {{-- SELLING PRICE --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Selling Price
                        </label>
                        <input type="number" name="selling_price"
                               value="{{ old('selling_price') }}"
                               class="w-full border rounded-lg px-3 py-2 mt-1"
                               placeholder="e.g. 15000"
                               required>
                    </div>

                    {{-- STOCK --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Stock
                        </label>
                        <input type="number" name="stock"
                               value="{{ old('stock') }}"
                               class="w-full border rounded-lg px-3 py-2 mt-1"
                               placeholder="Initial stock"
                               required>
                    </div>

                    {{-- SUBMIT --}}
                    <div class="pt-4">
                        <button type="submit"
                                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                            💾 Save Product
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>