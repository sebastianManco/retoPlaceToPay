<table class="table table-striped">
    <thead>
    <tr>
        <th>@lang('reports.title.name')</th>
        <th>@lang('reports.title.product')</th>
        <th>@lang('reports.title.created')</th>
        <th>@lang('reports.title.status')</th>
        <th>@lang('reports.title.total')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order as $orders)
        <tr>
            <td>{{ $orders->user->name }} {{ $orders->user->last_name }}</td>
            <td>{{ $orders->products[0]->name}}</td>
            <td>{{ $orders->created_at->format('d-m-Y') }}</td>
            <td>{{ $orders->payment->status }}</td>
            <td>{{ $orders->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
