<li class="nav-item dropdown">
    <a class="nav-link" href="{{route('cart.index')}}">

        <svg id="i-cart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <path d="M6 6 L30 6 27 19 9 19 M27 23 L10 23 5 2 2 2" />
            <circle cx="25" cy="27" r="2" />
            <circle cx="12" cy="27" r="2" />
        </svg>
    </a>
<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle"
       href="#" role="button" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-pill badge-dark">
                            <i class="fa fa-shopping-cart"></i> {{ \Cart::getTotalQuantity()}}
                        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="width: 450px; padding: 0px; border-color: #9DA0A2">
        <ul class="list-group" style="margin: 20px;">
            @include('Cart.cart-drop')
        </ul>

    </div>
</li>
