@extends('layouts.app')

@section('content')
<div class="card-body">
<div class="form-group row">
<a href=" {{route('usuarios.create')}} "><button type="button" class="btn btn-outline-success">Nuevo usuario</button></a>
</div>

<table class="table table-borderless">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Correo electronico</th>
        <th scope="col">Teléfono</th>
        <th scope="col">Fecha de inscripción</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
        @foreach($users as $users )
      <tr>
      <th scope="row">{{$users->id}}</th>
        <td>{{$users->name}}</td>
        <td>{{$users->last_name}}</td>
        <td>{{$users->email}}</td>
        <td>{{$users->phone}}</td>
        <td>{{$users->created_at}}</td>
        <td>
        
        
        <form method="POST" action="{{route('usuarios.destroy',$users->id)}}">

          
          <a href="{{route('usuarios.edit', $users->id)}}"><button type="button" 
            class="btn btn-outline-secondary">Editar</button></a>

          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-outline-danger">Eliminar</button>
        </form> 
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
    
@endsection