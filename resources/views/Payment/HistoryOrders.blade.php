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
                            @foreach($orders as $order )
                                <tr>
                                    <th scope="row">{{$order->id}}</th>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$order->total}}</td>
                                    <td>{{$order->payment->status}}</td>
                                    <td>
                                        <a href="{{route('reintentar', $order->id)}}">
                                            @if($order->payment->status =='PENDING' || $order->payment->status =='REJECTED')
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
