<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">➕ Add Category</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <div class="bg-white p-6 rounded shadow">

            <form method="POST" action="{{ route('categories.store') }}">
                @csrf

                <label class="block mb-2">Category Name</label>
                <input type="text" name="name"
                       class="w-full border p-2 rounded mb-4"
                       required>

                <button class="bg-green-600 text-white px-4 py-2 rounded">
                    Save
                </button>
            </form>

        </div>
    </div>
</x-app-layout>