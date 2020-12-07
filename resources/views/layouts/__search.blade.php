

<nav class="navbar navbar-light bg-light ">
    <form class="form-inline" metohd="GET">
        <select name="type" class="form-control mr-sm-2" id="tipo">
            <option>@lang('buttons.button.searchFor')</option>
            <option value="name">@lang('product.detail.name')</option>
            <option value="category">@lang('product.detail.category')</option>
        </select>
        <i class="fas fa-search" aria-hidden="true"></i>
        <input  name="search" class="form-control mr-sm-2 float-right"  type="search" id="name" placeholder="Buscar"
        aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
