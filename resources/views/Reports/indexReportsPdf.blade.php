@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>@lang('reports.index.title')</h2></div>
                    <div class="card-body">
                        <div class="form-group row">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>@lang('reports.index.number')</th>
                                    <th>@lang('reports.index.report')</th>
                                    <th>@lang('reports.index.date')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pdf as $pdfs)
                                    <tr>
                                        <td>{{ $pdfs->id }}</td>
                                        <td>
                                            <a href="{{ asset('/pdf/'. $pdfs->name) }}">{{ $pdfs->name }}</a>
                                        </td>
                                        <td>{{ $pdfs->created_at->format('d-m-Y') }}</td>
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
    </div>


@endsection
