@extends('layouts.app')

@section('content')
    <form action="{{ route('productImport')  }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" id="file" name="file">
        <button>Importar</button>
    </form>

@endsection
