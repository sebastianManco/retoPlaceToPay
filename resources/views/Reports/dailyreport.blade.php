<table>
    <thead>
    <tr>
    <th>requestId</th>
    <th>created at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($payment as $payments)
    <tr>
        <td>{{$payments->requestId}}</td>
        <td>{{$payments->created_at}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
