@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('orders.store') }}">
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
                    <input name="name"  type="text"  value="{{ $product->id }} ">{{ $product->name }}</td>

                <td>{{ $product->quantity }}</td>


                <td> <input name="unity" id="unity" type="text" value="{{number_format (Cart::session(auth()->id())->get($product->id)->getPriceSum())}}"></td>
            </tr>

        @empty
            <tr>
                There are no products in your basket.
            </tr>
        @endforelse

        </tbody>
    </table>
        <p class="cart-total float-right mr-5">
            <strong>Sub-Total</strong>:	$ {{ number_format(Cart::session(auth()->id())->getSubTotal()) }}<br>
            <strong>IVA (19%)</strong>: $ {{number_format( Cart::session(auth()->id())->getSubTotal()*0.19) }}<br>
            <strong>Total</strong>:<input type="text" name="total" id="total" value="{{number_format((Cart::session(auth()->id())->getSubTotal()*0.19)+Cart::session(auth()->id())->getSubTotal())}}"><br>
        <p class="buttons center">
        </p>
        <!--button type="submit" id="checkout"><a href="{{ route('checkout/index') }}">Checkout</a></button-->
        <button type="submit">Checkout</button>
    </form>

@endsection
