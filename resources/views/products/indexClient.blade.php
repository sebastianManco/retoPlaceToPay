@extends('layouts.app')

@section('content')


<div class="card-columns">
    @foreach($products as $products )
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
            <div class="card disabled"  aria-disabled="true"  style="width:400px">
                <div class="card-body">
                <img class="card-img-top" src="../../../images/{{ $products->image }}" alt="Card image" style="width:100%">
                <div class="card body">
                  <h4 class="card-title">{{$products->description }}</h4>
                  <a href="{{ route('products.show', $products->id) }}" class="btn btn-primary ">detalles</a>
                  <a href="{{ route('products.edit', $products->id) }}" class="btn btn-secondary ">Editar</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach 

    <div class="">
      {{-- $products->links() --}}
    </div>   
  </div>
  @endsection