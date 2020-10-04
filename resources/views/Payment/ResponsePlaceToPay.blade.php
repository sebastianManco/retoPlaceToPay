@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h2>resultado de la transaccion</h2></div>
                    <div class="card-body">

        <table class="table table-striped">
            <thead>
            <tr>

                <th> referencia</th>
                <th>Estado de la orden</th>
                <th>Total pagado</th>
            </tr>
            </thead>
            <tbody>
                <tr>

                    <td>
                        @if($response->payment == 'null')
                            pago pendiente
                        @endif
                        {{ $response->payment[0]->reference }}</td>
                    <td> {{ $response->status->status }}</td>
                    <td> {{ $response->payment[0]->amount->from->total }}</td>

                </tr>


            </tbody>
        </table>
    <form action="{{ route('cart.clear') }}" method="POST">
        @csrf
        <button class="btn btn-outline-info">Ir a la tienda</button>
    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
