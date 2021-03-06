@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>@lang('product.titles.createNewProduct')</h2></div>
            <div class="card-body">

    <form class="form-group" method="POST" action="/products"  enctype="multipart/form-data">
    @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">@lang('product.detail.name')</label>
            <div class="col-md-6">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" >
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">@lang('product.detail.description')</label>
                <div class="col-md-6">
                    <textarea  id="description" name="description"  class="form-control @error('description') is-invalid @enderror " value="">
                        {{old('description')}}
                    </textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="category_id" class="col-md-4 col-form-label text-md-right">@lang('product.detail.category')</label>
            <div class="col-md-6">
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" >
                    <option value="">--Elija la categoria--</option>
                    @foreach($categories as $category )
                        <option value="{{$category->id}}"> {{$category->name}} </option>
                    @endforeach
                </select>

                     @error('category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
        @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-md-4 col-form-label text-md-right" >@lang('product.detail.price')</label>
            <div class="col-md-6">
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">

            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="image" class="col-md-4 col-form-label text-md-right" > @lang('product.detail.image')</label>
            <div class="col-md-6">
            <input type="file" name="image" id="image"  class="form-control-file  @error('image') is-invalid @endError" value="{{old('image')}}">

            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="stock" class="col-md-4 col-form-label text-md-right" >@lang('product.detail.stock')</label>
            <div class="col-md-6">
            <input type="text" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{old('stock')}}">

            @error('stock')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-outline-primary">@lang('buttons.button.save')</button>
        <a href="{{route('products.index')}}"><button type="button" class="btn btn-outline-danger">@lang('buttons.button.cancel')</button>
        </a>
    </div>
</div>
    </form>
</div>
</div>
</div>
</div>
</div>
@endsection
