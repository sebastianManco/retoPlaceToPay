@extends('layouts.app')

@section('content')
    <h2>lista de productos</h2>
    <form class="form-inline" action="{{route('products.index')}}" metohd="GET">
      <i class="fas fa-search" aria-hidden="true"></i>
        <label for="description" >Nombre</label>
      <input class="form-control form-control-sm ml-3 w-75" id="name" type="text" placeholder="Search" name="filter[name]" aria-label="Search">
    </form>
<div class="card-columns">
    @foreach($products as $product )
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
            <div class="card disabled"  aria-disabled="true"  style="width:400px">
                <div class="card-body">
                <img class="card-img-top" src="../../../images/{{ $product->image }}" alt="Card image" style="width:100%">
                <div class="card body">
                  <h4 class="card-title">{{$product->name }}</h4>
                  <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary ">detalles</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach 
  </div>
  <div class="">
    {{ $products->links() }}
  </div>  
  @endsection