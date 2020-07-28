@extends('layouts.app')

@section('content')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Crear nueva categoria</h2></div>
            <div class="card-body">
                
    <form class="form-group" method="POST" action="/categories"  enctype="multipart/form-data">
    @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre </label>
            <div class="col-md-6">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>  
       
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-outline-primary">guardar</button>
        <a href="{{route('categories.index')}}"><button type="button" class="btn btn-outline-danger">Cancelar</button>
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