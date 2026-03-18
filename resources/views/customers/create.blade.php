<h1>Add Customer</h1>

<form action="{{ route('customers.store') }}" method="POST">
    @csrf

    Name: <input type="text" name="name"><br><br>
    Phone: <input type="text" name="phone"><br><br>
    Email: <input type="email" name="email"><br><br>

    <button type="submit">Save</button>
</form>