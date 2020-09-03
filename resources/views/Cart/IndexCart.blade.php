@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<section class="container text-center">
    <h3 class="py-3"><span>Cart Shop</span></h3>
</section>
<section class="main-content">
    <div class="row">
        <div class="col-md-12  ">

            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th> </th>
                        <th>Image</th>
                        <th>Name Product</th>
                        <th>quantity</th>
                        <th>price unit</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($cartProducts as $product)
                        <tr>
                            <td>
                                <a href="{{ route('cart.destroy', $product->id) }}">Borrar</a>
                            </td>
                            <td><img src="images/{{ $product->image }}" style="width:25%"> </td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <form action="{{ route('cart.update', $product->id) }}">
                                    <input name="quantity" type="number"  value="{{ $product->quantity }}">
                                    <input type="submit" value="Guardar">
                                </form>
                            </td>
                            <td>$ {{number_format ($product->price)}}</td>
                            <td>$ {{number_format (Cart::session(auth()->id())->get($product->id)->getPriceSum())}}</td>
                        </tr>

                    @empty
                        <tr>
                            There are no products in your basket.
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <hr>
            <p class="cart-total float-right mr-5">
                <strong>Sub-Total</strong>:	$ {{ Cart::session(auth()->id())->getSubTotal() }}<br>
                <strong>IVA (19%)</strong>: $NA<br>
                <strong>Total</strong>: $NA<br>
            </p>

            <p class="buttons center">
                <a href="{{ route('products/indexClient') }}" class="btn-sm">Continue</a>
                <button type="submit" id="checkout">Checkout</button>
            </p>
        </div>
    </div>
</section>
@endsection
