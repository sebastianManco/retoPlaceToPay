@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Editar Usuario</h2></div>

                <div class="card-body">
                <form method="POST" action="{{route('users.update', $user->id)}}">
                        @method('PUT')
                        @csrf
                                <!---campo de nombre---->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!---Campo de apellido---->
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Apelido</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user ->last_name }}" required autocomplete="name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <!---campo de email---->

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!---campo de telefono---->
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Número de teléfono</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="name" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--deshabilitar usuario-->
                            @if(Auth::user()->id == $user->id)
                    
                        @else
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">

                             <div class="custom-control custom-checkbox">
                             <input type="checkbox" class="custom-control-input" 
                             value="{{ $user->estado == 1 ? 1 : 0 }}" 
                              {{ $user->estado ==  1 ? "checked" :"" }}  id="customCheck" name="estado">
                                <label class="custom-control-label" for="customCheck">Usuario habilitado</label>
                            </div>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-primary">Actualizar</button>
                                <a href="{{ route('users.index') }}">
                                    <button type="button" class="btn btn-outline-danger">Cancelar</button>
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
