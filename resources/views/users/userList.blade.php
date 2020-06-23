@extends('layouts.app')

@section('content')
<a href="/home"><button type="button" class="btn btn-outline-secondary">Devolver</button></a>
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
        <a href="{{route('usuarios.edit', $users->id)}}"><button type="button" class="btn btn-primary">Editar</button></a>
        
        
        <form method="POST" action="{{route('usuarios.destroy',$users->id)}}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>  
      
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
    
@endsection