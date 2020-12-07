@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>@lang('payment.history.title')</h2></div>
                    <div class="card-body">

                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">@lang('payment.history.code')</th>
                                <th scope="col">@lang('payment.history.create')</th>
                                <th scope="col">@lang('payment.history.total')</th>
                                <th scope="col">@lang('payment.history.status')</th>
                                <th scope="col">@lang('payment.history.options')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment )

                                <tr>
                                    <th scope="row">{{$payment->order->id}}</th>


                                    <td>{{ $payment->order['created_at'] }}</td>
                                    <td>{{ $payment->order['total'] }}</td>
                                    <td>{{ $payment->status }}</td>
                                    <td>
                                        <a href="{{route('reintentar', $payment->order->id)}}">
                                            @if($payment->status =='PENDING' || $payment->status =='REJECTED'|| $payment->status =='iniciado')
                                                <button type="button" class="btn btn-outline-info">@lang('buttons.button.retry')</button>
                                                @endif
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <a href="{{ url('/home') }}" class="btn-sm">
                            <button type="button" class="btn btn-outline-danger">
                                @lang('payment.history.return')
                            </button>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection
