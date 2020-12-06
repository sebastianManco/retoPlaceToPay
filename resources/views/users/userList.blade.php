@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h2>@lang('users.titles.users')</h2></div>
          <div class="card-body">
            <div class="form-group row">
              <a href=" {{route('users.create')}} ">
                <button type="button" class="btn btn-outline-success">@lang('buttons.button.newUser')</button>
              </a>
            </div>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">@lang('users.detail.number')</th>
                    <th scope="col">@lang('users.detail.name')</th>
                    <th scope="col">@lang('users.detail.lastName')</th>
                    <th scope="col">@lang('users.detail.options')</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user )
                    <tr>
                      <th scope="row">{{$user->id}}</th>
                      <td>{{$user->name}}</td>
                      <td>{{$user->last_name}}</td>
                      <td>
                          <a href="{{route('users.show',$user->id)}}">
                            <button type="button" class="btn btn-outline-info">@lang('buttons.button.details')</button>
                          </a>
                          <a href="{{route('users.edit', $user->id)}}">
                            <button type="button" class="btn btn-outline-secondary">@lang('buttons.button.edit')</button>
                          </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div> {{ $users->links() }}</div>
          </div>

        </div>
      </div>
    </div>
  </div>


@endsection
