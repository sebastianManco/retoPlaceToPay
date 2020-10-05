@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>@lang('product.detail.title')</h2> </div>
                    <div class="card-body">
                    <p>Nombre: {{$product->name}}</p>
                    <p>categoria: {{ $product->category->name }} </p>
                    <p>Descripcion: {{$product->description}}</p>
                    <p>Precio: {{$product->price}}</p>
                        <p>Cantidad: {{$product->stock}}</p>
                    @if(Auth::guest() || Auth::user()->hasRole('admin'))
                    <p> Estado: {{ $product->active == 1  ? "habilitado" :"deshabilitado" }}</p>
                    @endif

                        @foreach($product->image as $images)
                            <img class=""  src="{{ asset($images->name) }}"   width="100" alt="Card image" style="width:100%">
                          @endforeach
                  @if(Auth::guest() || Auth::user()->hasRole('user'))
                        <a href="{{route('products/indexClient')}}"><button type="button" class="btn btn-outline-danger">cancelar</button></a>

                            <form action="{{ route('cart.add', $product->id) }}">
                                <div>
                                    <h3>unidad:</h3>
                                        <input name="quantity" type="number" class="input-small" value="1">

                                    <button type="submit"class="btn btn-outline-primary">agregar al carrito</button>
                                </div>

                        @else
                    <a href="{{route('products.index')}}"><button type="button" class="btn btn-outline-danger">cancelar</button></a>
                  @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection




