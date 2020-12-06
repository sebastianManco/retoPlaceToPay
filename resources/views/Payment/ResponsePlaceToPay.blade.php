@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h2>@lang('payment.title.result')</h2></div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>

                                <th>@lang('payment.response.reference')</th>
                                <th>@lang('payment.response.status')</th>
                                <th>@lang('payment.response.total')</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if($response->payment == 'null')
                                        <td> {{ $response->payment[0]->reference }}</td>
                                        <td> {{ $response->status->status }}</td>
                                        <td> {{ $response->payment[0]->amount->from->total }}</td>
                                    @else

                                    @endif
                                        <td> {{ $response->request->payment->reference }}</td>
                                        <td> {{ $response->status->status }}</td>
                                        <td> {{ $response->request->payment->amount->total }}</td>

                                </tr>


                            </tbody>
                        </table>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-info">@lang('buttons.button.goTo')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
