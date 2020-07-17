@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Detalles de producto</h2> </div>
                    <div class="card-body">
                    <p>Nombre: {{$product->description}}</p>
                    <p>Precio: {{$product->price}}</p>
                    <p>categoria: {{$product->Category_id}}</p>
                     {{-- $user->estado == 1  ? "habilitado" :"deshabilitado"--}}
                     <p>
                         <img src="../../../images/{{$product->image}}" alt="">
                     </p>
                    <a href="{{route('products.index')}}"><button type="button" class="btn btn-outline-danger">cancelar</button>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection