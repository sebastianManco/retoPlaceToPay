@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h2>Orden</h2></div>
                    <div class="card-body">

                         <form method="POST" action="{{route('checkout/index') }}">
                             @csrf
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name Product</th>
                                        <th>quantity</th>

                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cartProducts as $product)
                                        <tr>
                                            <td><img src="images/{{ $product->image }}" style="width:25%"> </td>
                                            <td>
                                                <input name="name"  type="hidden"  value="{{ $product->id }} ">{{ $product->name }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td> <input name="unity" id="unity" type="hidden" value="{{number_format (Cart::session(auth()->id())->get($product->id)->getPriceSum())}}">
                                                {{number_format (Cart::session(auth()->id())->get($product->id)->getPriceSum())}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            Orden vacia.
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                                <p class="cart-total float-right mr-5">
                                    <strong>Total</strong>:<input type="hidden" name="total" id="total" value="{{((Cart::session(auth()->id())->getSubTotal()*0.19)+Cart::session(auth()->id())->getSubTotal())}}">
                                    {{Cart::session(auth()->id())->getSubTotal()}}<br>
                                <p class="buttons center"></p>
                             <button type="submit" class="btn btn-outline-primary">pagar con placeToPay</button>
                                 <a href="{{ route('cart.index') }}">
                                    <button type="button" class="btn btn-outline-danger">Volver al carrito</button>
                                 </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
