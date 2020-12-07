@extends('layouts.app')

@section('content')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>@lang('product.titles.edit')</h2></div>
            <div class="card-body">

                <form class="form-group" method="POST" action="{{ route('products.update', $product->id) }}"  enctype="multipart/form-data">
                @method('PUT')
                @csrf

    <div class="form-group row">
        <label for="" class="col-md-4 col-form-label text-md-right">@lang('product.detail.name')</label>
        <div class="col-md-6">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $product->name }}">

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
    <div class="form-group row">
        <label for="" class="col-md-4 col-form-label text-md-right">@lang('product.detail.description')</label>
        <div class="col-md-6">
        <input type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$product->description}}">

        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
     @enderror
    </div>
</div>
    <div class="form-group row">
        <label for="description" class="col-md-4 col-form-label text-md-right">@lang('product.detail.category')</label>
        <div class="col-md-6">
        <select name="category_id" id="inputCategory_id" class="form-control">
        <option value="{{$product->category_id}}"> {{ $product->category->name }}</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}"> {{$category->name}} </option>
            @endforeach
        </select>
    </div>
</div>
        <div class="form-group row">
            <label for="" class="col-md-4 col-form-label text-md-right">@lang('product.detail.price')</label>
            <div class="col-md-6">
            <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}">

            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        </div>
        <div class="form-group row">
            <label for="file" class="col-md-4 col-form-label text-md-right">@lang('product.detail.image')</label>
            <div class="col-md-6">
                @foreach($product->image as $image)
            <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror" value="{{$image->name}}">
                @endforeach
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
        <div class="form-group row">
            <label for="" class="col-md-4 col-form-label text-md-right">@lang('product.detail.stock')</label>
            <div class="col-md-6">
            <input type="text" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{$product->stock}}">

            @error('stock')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
        <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input"
                    value="{{ $product->active == 1 ? 1 : 0 }}"
                    {{ $product->active ==  1 ? "checked" :"" }}  id="customCheck" name="active">
                <label class="custom-control-label" for="customCheck">@lang('product.detail.enabled')</label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">@lang('buttons.button.save')</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection
