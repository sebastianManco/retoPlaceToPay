@if ($products->isEmpty())
    <div class="alert alert-warning" role="alert">
        {{__('!No se han encontrado resultados')}}
    </div>
    @endif
<section>
  <div class="form-group row">
    <div class="card-columns">
    @foreach($products as $product )
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="card disabled"  aria-disabled="true"  style="width:200px">
            <div class="card-body">
            @foreach($product->image as $images)
              <img class=""  src="{{ asset($images->name) }}"   width="100" alt="Card image" style="width:100%">
              @endforeach
                <div class="card body">
                  <h4 class="card-title">{{$product->name }} </h4>

                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary ">{{__('detalles')}}</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-secondary ">{{__('Editar')}}</a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    </div>
  </div>
</section>
<div class="">
  {{ $products->links() }}
</div>

