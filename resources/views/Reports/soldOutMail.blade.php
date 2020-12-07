

<h2><strong>@lang('reports.soldOutMail.alert')</strong></h2>

<p>@lang('reports.soldOutMail.name')<strong> {{$product->name}} </strong> @lang('reports.soldOutMail.exhaust')</p>

<p>@lang('reports.soldOutMail.quantity')<strong>{{ $product->stock }}</strong></p>

<p>@lang('reports.soldOutMail.question')</p>

<p>@lang('reports.soldOutMail.click')</p>

<button>
    <a href="{{ route('products.edit', $product->id) }}">@lang('buttons.button.update')</a>
</button>
