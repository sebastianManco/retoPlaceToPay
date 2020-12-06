@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Historial de compras</h2></div>
                    <div class="card-body">

                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Código de orden</th>
                                <th scope="col">Fecha de creacion</th>
                                <th scope="col">Total de la transaccion</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment )
                                {{ $payment->order->id }}
                                <tr>
                                    <th scope="row"></th>
                                    <td>{{ $payment->order['created_at'] }}</td>
                                    <td>{{ $payment->order['total'] }}</td>
                                    <td>{{ $payment->status }}</td>
                                    <td>
                                        <a href="{{route('reintentar', $payment->order['id'])}}">
                                            @if($payment->status =='PENDING' || $payment->status =='REJECTED'|| $payment->status =='iniciado')
                                                <button type="button" class="btn btn-outline-info">Reintentar pago</button>
                                                @endif
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <a href="{{ url('/home') }}" class="btn-sm">
                            <button type="button" class="btn btn-outline-danger">
                                volver a la tienda
                            </button>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection
