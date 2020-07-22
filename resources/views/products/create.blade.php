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
        <select name="category_id" id="inputCategoria:id" class=·form-control>
            <option value="">--escoja la categoria--</option>></option>
            @foreach($category as $category )
            <option value="{{$category->id}}"> {{$category->name}} </option>
        @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="" >Precio</label>
        <input type="text" name="price" class="form-control">
    </div>
    <div class="form-group">
        <label for="" >Imagen</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="" >Cantidad del prodcuto</label>
        <input type="text" name="stock" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">guardar</button>
</form>
@endsection