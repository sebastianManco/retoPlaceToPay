@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Auth::guest() || Auth::user()->hasRole('user'))
                        <a href="{{route('products/indexClient')}}"><button type="button" class="btn btn-outline-primary">@lang('buttons.button.product')</button></a>
                            <a href="{{route('orders.index')}}"><button type="button" class="btn btn-outline-primary">@lang('buttons.button.shopping')</button></a>
                    @else
                        <a href="{{route('users.index')}}"><button type="button" class="btn btn-outline-primary">@lang('buttons.button.user')</button></a>
                        <a href="{{route('products.index')}}"><button type="button" class="btn btn-outline-primary">@lang('buttons.button.product')</button></a>
                        <a href="{{route('categories.index')}}"><button type="button" class="btn btn-outline-primary">@lang('buttons.button.categories')</button></a>
                            <a href="{{route('businessManagement')}}"><button type="button" class="btn btn-outline-primary">@lang('buttons.button.management')</button></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
