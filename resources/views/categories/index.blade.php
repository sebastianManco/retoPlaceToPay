@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h2>Categorias</h2></div>
          <div class="card-body">
            <div class="form-group row">
                <a href=" {{route('categories.create')}} ">
                    <button type="button" class="btn btn-outline-success">Nueva categoría</button>
                  </a>
            </div>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Número</th>
                    <th scope="col">Nombre categoría</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($category as $categories )
                    <tr>
                      <th scope="row">{{$categories->id}}</th>
                      <td>{{$categories->name}}</td>
                      <td>        
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div> {{--$users->links() --}}</div>
          </div>
          
        </div>
      </div>
    </div>
  </div>

    
@endsection