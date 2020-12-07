@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h2>@lang('cart.title.cart')</h2></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <section class="main-content">
                            <div class="row">
                                <div class="col-md-15  ">

                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>@lang('cart.details.remove')</th>
                                                <th>@lang('cart.details.name')</th>
                                                <th>@lang('cart.details.quantity')</th>
                                                <th>@lang('cart.details.modify')</th>
                                                <th>@lang('cart.details.unitPrice')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($cartProducts as $product)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('cart.destroy', $product->id) }}">
                                                            <button type="button" class="btn btn-outline-danger">@lang('buttons.button.destroy')</button>
                                                        </a>
                                                    </td>
                                                    <td>{{ $product->name }}</td>
                                                    <td> {{ $product->quantity }}</td>
                                                    <td>
                                                        <form class="form-inline" action="{{ route('cart.update', $product->id) }}">
                                                            <input name="quantity" type="number" class="form-control form-control-sm"  value="{{ $product->quantity }}">
                                                            <button type="submit" class="btn btn-outline-success">@lang('buttons.button.edit')</button>
                                                        </form>
                                                    </td>
                                                    <td>$ {{number_format ($product->price)}}</td>
                                                </tr>

                                            @empty
                                                <tr>
                                                    su carrito esta vacío
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <hr>
                                    <p class="cart-total float-right mr-5">
                                        <strong>Total</strong>: ${{number_format(Cart::session(auth()->id())->getSubTotal())}}<br>
                                    <p class="buttons center">
                                    </p>
                                    <a href="{{ route('orders.create') }}" class="btn-sm">
                                    <button type="button" class="btn btn-outline-primary">
                                        @lang('buttons.button.continue')
                                    </button>
                                    </a>
                                    <a href="{{ route('products/indexClient') }}" class="btn-sm">
                                        <button type="button" class="btn btn-outline-danger">
                                            @lang('buttons.button.goTo')
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

