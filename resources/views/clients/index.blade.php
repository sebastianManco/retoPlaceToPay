
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h2>{{__('Lista de productos cliente')}}</h2>
        </div>
          <div class="card-body">
                @include('layouts.__search')
          </div>
          @if ($products->isEmpty())
              <div class="alert alert-warning" role="alert">
                  {{__('!No se han encontrado resultados')}}
              </div>
          @endif
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
                                                  <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary ">{{__('detalles')}}</a>
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
