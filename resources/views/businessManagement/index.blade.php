@extends('layouts.app')

@section('content')
<div class="modal" tabindex="-1" id="file">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecciona archivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="importProductForm" action="{{ route('productImport')  }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file" name="file">
                        <label class="custom-file-label" for="file">choose file</label>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary">Close</button>
                <button type="submit" form="importProductForm" class="btn btn-primary">Importar</button>
            </div>
        </div>
    </div>
</div>

<a class="nav-link" href="#!" data-toggle="modal" data-target="#file">importar</a>

    <form action="{{ route('productUpdateImport')  }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" id="archivo" name="archivo">
        <button>Importar actualizacion</button>
    </form>

    <form action="{{route('customReport')}}" method="get">
        @csrf
        desde <input type="datetime-local" name="dateFrom"  id="dateFrom">
        hasta <input type="datetime-local" name="dateTo"  id="dateTo">
        <button type="submit">enviar</button>
    </form>

    <a href="{{route('indexReport')}}"><button> reportes generados</button></a>

@endsection
