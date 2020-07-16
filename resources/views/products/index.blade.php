
@extends('layouts.app')

@section('content')

<div class="form-group row">
    <a href=" {{route('products.create')}} ">
      <button type="button" class="btn btn-outline-success">Nuevo usuario</button>
    </a>
</div>

                    <table class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Número</th>
                            <th scope="col">descripcion</th>
                            <th scope="col">precio</th>
                            <th scope="col">opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($products as $products )
                            <tr>
                              <th scope="row">{{$products->id}}</th>
                              <td>{{$products->description}}</td>
                              <td>{{$products->price}}</td>
                              <td>
                                <a href="{{route('products.show', $products->id)}}">
                                    <button type="button" class="btn btn-outline-primary">detalles</button>
                                </a>                                                
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      

                      @endsection