@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>@lang('users.titles.details')</h2></div>

                <div class="card-body">
                <form method="POST" action="{{route('users.update', $user->id)}}">
                        @method('PUT')
                        @csrf
                            @include('layouts.__createUser')

                            @if(Auth::user()->id == $user->id)

                        @else
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">

                             <div class="custom-control custom-checkbox">
                             <input type="checkbox" class="custom-control-input"
                             value="{{ $user->estado == 1 ? 1 : 0 }}"
                              {{ $user->estado ==  1 ? "checked" :"" }}  id="customCheck" name="estado">
                                <label class="custom-control-label" for="customCheck">@lang('users.detail.enabled')</label>
                            </div>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-primary">@lang('buttons.button.update')</button>
                                <a href="{{ route('users.index') }}">
                                    <button type="button" class="btn btn-outline-danger">@lang('buttons.button.cancel')</button>
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
