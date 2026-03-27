<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            ➕ Add New Supplier
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-6 rounded-2xl shadow">

                <form method="POST" action="{{ route('suppliers.store') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Supplier Name *
                        </label>
                        <input type="text" name="name"
                               value="{{ old('name') }}"
                               class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200"
                               required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Phone
                        </label>
                        <input type="text" name="phone"
                               value="{{ old('phone') }}"
                               class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
                    </div>

                    <!-- Address -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Address
                        </label>
                        <textarea name="address"
                                  rows="3"
                                  class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">{{ old('address') }}</textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center">
                        <a href="{{ route('products.create') }}"
                           class="text-gray-600 hover:underline">
                            ← Back
                        </a>

                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
                            💾 Save Supplier
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>