
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h2>Lista de productos admin </h2></div>
          <div class="card-body">
            <nav class="navbar navbar-light bg-light ">
                <a href=" {{route('products.create')}} ">
                  <button type="button" class="btn btn-outline-success">Nuevo producto</button>
                </a>

                <form class="form-inline" action="{{route('products.index')}}" metohd="GET">
                    <select name="type" class="form-control mr-sm-2" id="tipo">
                      <option>Buscar por </option>
                      <option value="name">nombre</option>
                      <option value="category">categoría</option>
                    </select>
                  <i class="fas fa-search" aria-hidden="true"></i>
                  <input  name="search" class="form-control mr-sm-2 float-right"  type="search" id="name" placeholder="Buscar" 
                  aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
              </nav>
          </div>
              <section>
                <div class="form-group row">
              <div class="card-columns">
                @foreach($products as $product )
                <div class="container">
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="card disabled"  aria-disabled="true"  style="width:200px">
                            <div class="card-body">
                        @foreach($product->image as $images)
                            <img class=""  src="{{ asset($images->name) }}"   width="100" alt="Card image" style="width:100%">
                          @endforeach   
                            <div class="card body">
                              <h4 class="card-title">{{$product->name }} </h4>
                              <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary ">detalles</a>
                              <a href="{{ route('products.edit', $product->id) }}" class="btn btn-secondary ">Editar</a>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach        
              </div>
            </div>
            </section>
              <div class="">
                {{ $products->links() }}
              </div>
          </div>
        
      </div>
    </div>
    </div>
@endsection