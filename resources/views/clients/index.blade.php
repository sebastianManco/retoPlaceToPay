
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
        @include('layouts.__indexProducts')
      </div>
    </div>
  </div>
</div>
@endsection