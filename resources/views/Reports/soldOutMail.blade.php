<h4>Alerta!</h4>

el producto: <strong> {{$product->name}} </strong> está que se agota.

solo quedan <strong>{{ $product->stock }}</strong>

¿ya tienes mas unidades disponibles?

da clink en actualizar para no parar de vender

<button><a href="{{route('products.edit', $product->id)}}">actualizar</a></button>
