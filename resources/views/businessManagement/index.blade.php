@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>@lang('management.buttons.title')</h2></div>

                    <div class="card-body">
                        <h4>@lang('management.details.productsExports')</h4>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right" >  </label>
                            <div class="col-md-6">
                                <a href="{{route('export.product')}}"><button class="btn btn-outline-primary ">@lang('management.buttons.export')</button></a>
                            </div>
                        </div>
                        <h4>@lang('management.details.productsImport')</h4>
                         <form class="form-group" action="{{ route('productImport')  }}" method="post" enctype="multipart/form-data">
                             @csrf
                             <div class="form-group row">
                                 <label for="image" class="col-md-4 col-form-label text-md-right" >@lang('management.buttons.import')</label>
                                 <div class="col-md-6">
                                     <div class="custom-file">
                                        <input  type="file" id="file" name="file" >
                                     </div>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="image" class="col-md-4 col-form-label text-md-right" ></label>
                                 <div class="col-md-6">
                                     <button class="btn btn-outline-primary ">@lang('management.buttons.import')</button>
                                 </div>
                             </div>
                         </form>


                        <h4>@lang('management.details.productUpdateImport')</h4>
                        <form class="form-group" action="{{ route('productUpdateImport')  }}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right" >@lang('management.buttons.import')</label>
                                <div class="col-md-6">
                                    <input  type="file" id="updateFile" name="updateFile" >
                                </div>
                            </div>
                                <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label text-md-right" ></label>
                                    <div class="col-md-6">
                                        <button class="btn btn-outline-primary ">@lang('management.buttons.importUpdate')</button>
                                    </div>
                                </div>
                        </form>
                        <h4>@lang('management.details.customReports')</h4>
                            <form class="form-group" action="{{route('customReport')}}" method="get">
                                @csrf
                                <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label text-md-right" >@lang('management.details.dateFrom')</label>
                                    <div class="col-md-6">
                                        <input type="datetime-local" name="dateFrom"  id="dateFrom">
                                    </div>

                                    <label for="image" class="col-md-4 col-form-label text-md-right" >@lang('management.details.dateTo')</label>
                                    <div class="col-md-6">
                                        <input type="datetime-local" name="dateTo"  id="dateTo">
                                    </div>
                                </div>

                                    <div class="form-group row">
                                        <label for="image" class="col-md-4 col-form-label text-md-right" ></label>
                                        <div class="col-md-6">
                                            <button class="btn btn-outline-primary ">@lang('management.buttons.send')</button>
                                        </div>
                                    </div>
                            </form>

                        <h4>@lang('management.details.history')</h4>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right" >  </label>
                            <div class="col-md-6">
                                <a href="{{route('indexReport')}}"><button class="btn btn-outline-primary ">@lang('management.buttons.report')</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
