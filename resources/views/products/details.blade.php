@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>@lang('product.titles.details')</h2> </div>
                    <div class="card-body">
                    <p>@lang('product.detail.name'): {{ $product->name }}</p>
                    <p>@lang('product.detail.category'): {{ $product->category->name }} </p>
                    <p>@lang('product.detail.description'): {{ $product->description }}</p>
                    <p>@lang('product.detail.price'): {{ $product->price }}</p>
                        <p>@lang('product.detail.quantity'): {{ $product->stock }}</p>
                    @if(Auth::guest() || Auth::user()->hasRole('admin'))
                    <p> @lang('product.detail.status') {{ $product->active == 1  ? "habilitado" :"deshabilitado" }}</p>
                    @endif
                        @foreach($product->image as $images)
                            <img class=""  src="{{ asset($images->name) }}"   width="300" height="300" alt="Card image">
                          @endforeach

                    @if(Auth::guest() || Auth::user()->hasRole('user'))
                        <div class="class row">
                            <div class="col-sm">
                                <a href="{{ route('products/indexClient') }}"><button type="button" class="btn btn-outline-danger">@lang('buttons.button.cancel')</button></a>
                            </div>
                        </div>
                            <form action="{{ route('cart.add', $product->id) }}">
                                <div>
                                    <h3>@lang('product.detail.unit')</h3>
                                        <input name="quantity" type="number" class="input-small" value="1">

                                    <button type="submit"class="btn btn-outline-primary">@lang('buttons.button.addCart')</button>
                                </div>
                    @else
                       <div class="class row">
                           <div class="col-sm">
                        <a href="{{ route('products.index') }}"><button type="button" class="btn btn-outline-danger">@lang('buttons.button.cancel')</button></a>
                           </div>
                       </div>
                    @endif
                </div>

            </div>
            </div>
        </div>
    </div>

</div>
@endsection




