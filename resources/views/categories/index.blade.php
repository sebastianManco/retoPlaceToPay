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
                    <button type="button" class="btn btn-outline-success">@lang('buttons.button.newCategory')</button>
                  </a>
            </div>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">@lang('categories.detail.number')</th>
                    <th scope="col">@lang('categories.detail.name')</th>
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
          </div>

        </div>
      </div>
    </div>
  </div>


@endsection
