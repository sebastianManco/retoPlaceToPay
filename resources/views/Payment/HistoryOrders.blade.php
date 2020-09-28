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
                                <th scope="col">codigo de orden</th>
                                <th scope="col">fecha de creacion</th>
                                <th scope="col">estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order )
                                <tr>
                                    <th scope="row">{{$order->id}}</th>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$order->payment->status}}</td>
                                    <td>
                                        <a href="">
                                            <button type="button" class="btn btn-outline-info">Detalles</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
