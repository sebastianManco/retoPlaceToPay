@extends('layouts.app')

@section('content')
    <form action="{{ route('productImport')  }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" id="file" name="file">
        <button>Importar</button>
    </form>

    <form action="{{ route('productUpdateImport')  }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" id="archivo" name="archivo">
        <button>Importar actualizacion</button>
    </form>

    <form action="{{route('job.product')}}" method="get">
        @csrf
        desde <input type="datetime-local" name="dateFrom"  id="dateFrom">
        hasta <input type="datetime-local" name="dateTo"  id="dateTo">
        <button type="submit">enviar</button>
    </form>

@endsection
