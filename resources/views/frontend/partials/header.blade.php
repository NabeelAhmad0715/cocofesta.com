<header id="header" class="header fancy">
  <div class="topbar">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 xs-mb-10">
        <div class="topbar-call text-center text-md-left">
          <ul>
            <li><i class="fa fa-envelope-o theme-color"></i> gethelp@webster.com</li>
             <li><i class="fa fa-phone"></i> <a href="tel:+7042791249"> <span>+(704) 279-1249 </span> </a> </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-6 col-md-6">
        <div class="topbar-social text-center text-md-right">
          <ul>
            <li><a href="#"><span class="ti-facebook"></span></a></li>
            <li><a href="#"><span class="ti-instagram"></span></a></li>
            <li><a href="#"><span class="ti-google"></span></a></li>
            <li><a href="#"><span class="ti-twitter"></span></a></li>
            <li><a href="#"><span class="ti-linkedin"></span></a></li>
            <li><a href="#"><span class="ti-dribbble"></span></a></li>
          </ul>
        </div>
      </div>
     </div>
  </div>
</div>

<!--=================================
 mega menu -->

<div class="menu">
  <div class="container">
    <div class="row">
     <div class="col-lg-12 col-md-12">
     <!-- menu start -->
       <nav id="menu" class="mega-menu">
        <!-- menu list items container -->
        <section class="menu-list-items">
        <!-- menu logo -->
        <ul class="menu-logo">
            <li>
                <a href="index-01.html"><img id="logo_img" src="{{ asset('images/logo.png') }}" alt="logo"> </a>
            </li>
        </ul>
        <!-- menu links -->
        <div class="menu-bar">
         <ul class="menu-links">

          <li><a href="{{ route('pages.home') }}">Home</a></li>
          <li><a href="{{ route('pages.about') }}">About</a></li>
          @if ($type)
            <li><a href="{{ route('pages.products',[$type->slug]) }}"> {{ $type->title }}</a>
            </li>
          @endif
            <li><a href="{{ route('pages.contact-us') }}">Contact Us</a></li>
            @auth
            <li class="active"><a href="javascript:void(0)">{{ auth()->user()->name }}<i class="fa fa-angle-down fa-indicator"></i></a>
              <ul class="drop-down-multilevel">
                  <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                    </li>
              </ul>
            </li>
           @else
              <li><a class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-white c-btn-circle c-btn-uppercase c-btn-sbold" href="{{ route('login') }}" style="padding: 5px 15px 5px 15px;"><span class="fa fa-lock" style="margin-right:5px"></span>Login</a></li>

              <li><a class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-white c-btn-circle c-btn-uppercase c-btn-sbold"  style="padding: 5px 15px 5px 15px;" href="{{ route('register') }}"><span class="fa fa-users" style="margin-right:5px"></span>Signup</a></li>
           @endauth
        </ul>
        <div class="search-cart">
          <div class="search">
            <a class="search-btn not_click" href="javascript:void(0);"></a>
              <div class="search-box not-click">
                 <form action="search.html" method="get">
                  <input type="text"  class="not-click form-control" name="search" placeholder="Search.." value="" >
                  <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                </form>
           </div>
          </div>
          <div class="whishlist" style="padding:20px">
            <a class="whishlist-btn" href="{{ route('pages.whishlist') }}"> <i class="fa fa-heart icon"></i> <strong id="whishlistCount" class="item">
              @isset($whishlistCount)
              {{ $whishlistCount }}
              @else
              0
              @endisset
            </strong></a>
          </div>

          <div class="shpping-cart" style="padding: 20px 20px 20px 10px;">
           <a class="cart-btn" href="#"> <i class="fa fa-shopping-cart icon"></i> <strong id="cartCount" class="item">
            @isset($cartCount)
           {{ $cartCount }}
           @else
           0
           @endisset
         </strong></a>
            <div class="cart">
                <div id="cart-success-remove-message">
              <div class="cart-title">
                 <h6 class="uppercase mb-0">Shopping cart</h6>
              </div>
              @isset($cartPosts)
              @forelse ($cartPosts as $cart)
                <div class="cart-item">
                    <div class="cart-image">
                    <img class="img-fluid" src="images/shop/01.jpg" alt="">
                    </div>
                    <div class="cart-name clearfix">
                    <a href="#">{{ $cart->post->title }} <strong>x{{ $cart->quantity }}</strong></a>
                    <div class="cart-price">
                        <del>{{ $cart->price }}</del>
                          <ins>{{ $cart->post->getMetaData('discount') ? round($cart->post->getMetaData('price') - ($cart->post->getMetaData('price') * ($cart->post->getMetaData('discount')/100))) : $cart->post->getMetaData('price') }}</ins>
                    </div>
                    </div>
                    <div class="cart-close">
                        <a data-data="{{ $cart->post->id }}" class="removetocart" href='javascript:;'><i class="fa fa-times-circle"></i></a>
                    </div>
                </div>
              @empty
                  <h2>Cart is Empty</h2>
              @endforelse
              @endisset
              <div class="cart-total">
                <h6 class="mb-15"> Total: $@isset($cartPosts) {{ $cartPosts->sum('price') }}@endisset</h6>
                <a class="button" href="{{ route('pages.cart') }}">View Cart</a>
                  <a class="button black" href="{{ route('pages.checkout') }}">Checkout</a>
              </div>
            </div>
          </div>
        </div>
        </div>
       </section>
         </nav>
       </div>
     </div>
    </div>
   </div>
  <!-- menu end -->
</header>
@push('scripts')
    <script src="{{asset('backend/js/cart-remove.js') }}"></script>
@endpush
