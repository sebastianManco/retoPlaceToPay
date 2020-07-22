@extends('layouts.app')

@section('content')
@section('content')

    <form class="form-group" method="POST" action="{{ route('products.update', $product->id) }}"  enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="" >Nombre</label>
        <input type="text" name="description" class="form-control" value="{{$product->description}}">
    </div>

    <div class="form-group">


        <select name="category_id" id="inputCategoria:id" class=·form-control>
        <option value="{{$product->category_id}}"> {{ $product->category->name }}</option>
            @foreach($category as $categories)
            <option value="{{ $categories->id }}"> {{$categories->name}} </option>
            @endforeach
        </select>
    
    
    
    </div>
    <div class="form-group">
        <label for="" >precio</label>
        <input type="text" name="price" class="form-control" value="{{$product->price}}">
    </div>
    <div class="form-group">
        <label for="" >Imagen</label>
        <input type="file" name="image" class="form-control" value="{{$product->image}}">
    </div>
    <div class="form-group">
        <label for="" >Cantidad del prodcuto</label>
        <input type="text" name="stock" class="form-control">
    </div>

    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" 
        value="{{ $product->active == 1 ? 1 : 0 }}" 
         {{ $product->active ==  1 ? "checked" :"" }}  id="customCheck" name="active">
           <label class="custom-control-label" for="customCheck">producto habilitado</label>
       </div>

    <button type="submit" class="btn btn-primary">guardar</button>
</form>
@endsection