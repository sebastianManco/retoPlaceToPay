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
                    <a href="/home/userList"><button type="button" class="btn btn-outline-primary">lista de usuarios</button></a> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
