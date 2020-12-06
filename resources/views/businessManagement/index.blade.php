@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>gestion del negocio</h2></div>

                    <div class="card-body">
                        <h4>los productos agregados a su tienda seran exportados en un archivo excel</h4>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right" >  </label>
                            <div class="col-md-6">
                                <a href="{{route('export.product')}}"><button class="btn btn-outline-primary ">exportar</button></a>
                            </div>
                        </div>
                        <h4>Aqui puede importar nuevos products de forma masiva sus productos. Archivos admitivos .xlsx</h4>
                         <form class="form-group" action="{{ route('productImport')  }}" method="post" enctype="multipart/form-data">
                             @csrf
                             <div class="form-group row">
                                 <label for="image" class="col-md-4 col-form-label text-md-right" >importar </label>
                                 <div class="col-md-6">
                                     <div class="custom-file">
                                        <input  type="file" id="file" name="file" >
                                     </div>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="image" class="col-md-4 col-form-label text-md-right" ></label>
                                 <div class="col-md-6">
                                     <button class="btn btn-outline-primary ">Importar </button>
                                 </div>
                             </div>
                         </form>


                        <h4> ¿Exportó una cantidad de productos para actualizarlos ?Aqui puede importar y actualizar de forma masiva sus productos. Archivos admitidos .xlsx</h4>
                        <form class="form-group" action="{{ route('productUpdateImport')  }}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right" >importar actualizacion</label>
                                <div class="col-md-6">
                                    <input  type="file" id="updateFile" name="updateFile" >
                                </div>
                            </div>
                                <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label text-md-right" ></label>
                                    <div class="col-md-6">
                                        <button class="btn btn-outline-primary ">Importar actualizacion</button>
                                    </div>
                                </div>
                        </form>
                        <h4> Genera su reporte de ventas personalizados. seleccione los rangos de fecha y tendrá su reporte </h4>
                            <form class="form-group" action="{{route('customReport')}}" method="get">
                                @csrf
                                <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label text-md-right" >desde</label>
                                    <div class="col-md-6">
                                        <input type="datetime-local" name="dateFrom"  id="dateFrom">
                                    </div>

                                    <label for="image" class="col-md-4 col-form-label text-md-right" >hasta</label>
                                    <div class="col-md-6">
                                        <input type="datetime-local" name="dateTo"  id="dateTo">
                                    </div>
                                </div>

                                    <div class="form-group row">
                                        <label for="image" class="col-md-4 col-form-label text-md-right" ></label>
                                        <div class="col-md-6">
                                            <button class="btn btn-outline-primary ">enviar</button>
                                        </div>
                                    </div>
                            </form>

                        <h4>consulte el historial de los reportes generados</h4>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right" >  </label>
                            <div class="col-md-6">
                                <a href="{{route('indexReport')}}"><button class="btn btn-outline-primary ">reportes generados</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
