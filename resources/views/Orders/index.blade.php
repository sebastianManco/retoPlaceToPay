@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h2>@lang('order.title.order')</h2></div>
                    <div class="card-body">

                         <form method="POST" action="{{route('checkout/index') }}">
                             @csrf
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>@lang('order.order.name')</th>
                                        <th>@lang('order.order.quantity')</th>
                                        <th>@lang('order.order.total')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cartProducts as $product)
                                        <tr>

                                                <input name="name" id="name" type="hidden"  value="{{ $product->id }} ">{{ $product->name }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>$ <input name="unity" id="unity" type="hidden" value=" {{number_format (Cart::session(auth()->id())->get($product->id)->getPriceSum())}}">
                                                {{number_format (Cart::session(auth()->id())->get($product->id)->getPriceSum())}}</td>
                                            <td><input type="hidden" name="total" id="total" value="{{((Cart::session(auth()->id())->getSubTotal()*0.19)+Cart::session(auth()->id())->getSubTotal())}}">
                                                $ {{ number_format (Cart::session(auth()->id())->getSubTotal())}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            @lang('order.order.empty')
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                                <p class="buttons center"></p>
                             <button type="submit" class="btn btn-outline-primary">@lang('buttons.button.pay')</button>
                                 <a href="{{ route('cart.index') }}">
                                    <button type="button" class="btn btn-outline-danger">@lang('buttons.button.back')</button>
                                 </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
