@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h2>Usuarios</h2></div>
          <div class="card-body">
            <div class="form-group row">
              <a href=" {{route('users.create')}} ">
                <button type="button" class="btn btn-outline-success">Nuevo usuario</button>
              </a>
            </div>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Número</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $users )
                    <tr>
                      <th scope="row">{{$users->id}}</th>
                      <td>{{$users->name}}</td>
                      <td>{{$users->last_name}}</td>
                      <td>
                        <form method="POST" action="{{route('users.destroy',$users->id)}}">
                          <a href="{{route('users.show',$users->id)}}">
                            <button type="button" class="btn btn-outline-info">Detalles</button>
                          </a>          
                          <a href="{{route('users.edit', $users->id)}}">
                            <button type="button" class="btn btn-outline-secondary">Editar</button>
                          </a>
                          @csrf
                          @method('DELETE')
                          <!--<button type="submit" class="btn btn-outline-danger">Eliminar</button>-->
                        </form> 
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    
@endsection