
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h2>{{__('Lista de productos admin')}} </h2>
        </div>
        <div class="card-body">
          <nav class="navbar navbar-light bg-light ">
            <a href=" {{route('products.create')}} ">
              <button type="button" class="btn btn-outline-success">{{__('Nuevo producto')}}</button>
            </a>
            @include('layouts.__search')
          </nav>
        </div>
          @include('layouts.__indexProducts')         
      </div>
    </div>
  </div>
</div>
@endsection