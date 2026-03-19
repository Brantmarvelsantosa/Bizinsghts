<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👥 Customers
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ➕ ADD CUSTOMER --}}
            <a href="{{ route('customers.create') }}"
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
                ➕ Add Customer
            </a>

            <div class="bg-white shadow-sm rounded-lg p-6">

                <table border="1" cellpadding="10" cellspacing="0" width="100%">
                    <thead style="background:#f3f4f6;">
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($customers as $c)
                        <tr>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->phone }}</td>
                            <td>{{ $c->email }}</td>
                            <td>
                                <a href="{{ route('customers.edit',$c->id) }}">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('customers.destroy',$c->id) }}"
                                      method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('Delete this customer?')">
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