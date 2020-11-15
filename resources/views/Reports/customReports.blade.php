<table class="table table-striped">
    <thead>
    <tr>
        <th>Nombre Comprador</th>
        <th>producto</th>
        <th>created at</th>
        <th>status</th>
        <th>total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order as $orders)
        <tr>
            <td>{{ $orders->user->name }} {{ $orders->user->last_name }}</td>
            <td>{{ $orders->products[0]->name}}</td>
            <td>{{ $orders->payment->requestId }}</td>
            <td>{{ $orders->created_at }}</td>
            <td>{{ $orders->payment->status }}</td>
            <td>{{ $orders->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
