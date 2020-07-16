@extends('layouts.app')

@section('content')
@section('content')

    <form class="form-group" method="POST" action="/products"  enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="" >Nombre</label>
        <input type="text" name="description" class="form-control">
    </div>
    <div class="form-group">
        <label for="" >Precio</label>
        <input type="text" name="price" class="form-control">
    </div>
    <div class="form-group">
        <label for="" >Imagen</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">guardar</button>
</form>
@endsection