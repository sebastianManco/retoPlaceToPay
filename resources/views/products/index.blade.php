
@extends('layouts.app')

@section('content')

  <div class="form-group row">
    <a href=" {{route('products.create')}} ">
      <button type="button" class="btn btn-outline-success">Nuevo producto</button>
    </a>
  </div>
      <h2>lista de productos</h2>
        <form class="form-inline" action="{{route('products.index')}}" metohd="GET">
          <i class="fas fa-search" aria-hidden="true"></i>
            <label for="description" >Nombre</label>
          <input class="form-control form-control-sm ml-3 w-75" id="description" type="text" placeholder="Search" name="filter[description]" aria-label="Search">
        </form>
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