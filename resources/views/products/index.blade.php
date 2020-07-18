
@extends('layouts.app')

@section('content')

  <div class="form-group row">
      <a href=" {{route('products.create')}} ">
        <button type="button" class="btn btn-outline-success">Nuevo producto</button>
      </a>
  </div>
  <div class="card-gruop">
  <div class="container">
    <h2>lista de productos</h2>

<div class="card-body">
<form action="{{route('products.index')}}" metohd="GET">
  <div class="form-group">
    <label for="description" >Nombre</label>
    <input id="description" type="text" name="filter[description]" class="form-control" value="">
</div>
</form>
</div>
<div class="card-columns">
  @foreach($products as $products )
  <div class="row">
    <div class="col-sm-6">
        <div class="card " style="width:400px">
            <div class="card-body">
            <img class="card-img-top" src="../../../images/{{ $products->image }}" alt="Card image" style="width:100%">
            <div class="card body">
              <h4 class="card-title">{{$products->description }}</h4>
              <a href="{{ route('products.show', $products->id) }}" class="btn btn-primary stretched-link">detalles</a>
              <a href="{{ route('products.edit', $products->id) }}" class="btn btn-secondary stretched-link">Editar</a>
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