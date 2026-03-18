<h1>👥 Customers</h1>

<a href="{{ route('customers.create') }}">➕ Add Customer</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

@foreach($customers as $c)
<tr>
    <td>{{ $c->name }}</td>
    <td>{{ $c->phone }}</td>
    <td>{{ $c->email }}</td>
    <td>
        <a href="{{ route('customers.edit',$c->id) }}">✏️ Edit</a>

        <form action="{{ route('customers.destroy',$c->id) }}"
              method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">🗑️ Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>