@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Detalles de usuario</h2> </div>
                    <div class="card-body">
                    <p>Nombre: {{$user->name .' ' . $user->last_name}}</p>
                    <p>Correo electrónico: {{$user->email}}</p>
                    <p>teléfono: {{$user->phone}}</p>
                    <p>Estado: {{ $user->estado == 1  ? "habilitado" :"deshabilitado"}}</p>
                    <a href="{{route('usuarios.index')}}"><button type="button" class="btn btn-outline-danger">cancelar</button>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection