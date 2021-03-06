@extends('frontend.layouts.layout')

@section('head')
    <title>Cart | Coco Cart</title>
    <meta name="description" content="Coco Cart">
    <meta name="keywords" content="Coco Cart">
@endsection

@section('content')
{{ session(['link' => url()->current()]) }}
<section class="page-title bg-overlay-black-60 parallax" data-jarallax='{"speed": 0.6}' style="background-image: url({{ asset('images/bg/02.jpg') }});">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="page-title-name">
            <h1>Cart</h1>
            <p>We know the secret of your success</p>
          </div>
            <ul class="page-breadcrumb">
              <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>Cart</span> </li>
         </ul>
       </div>
       </div>
    </div>
    <div class="overlay"></div>
</section>
@auth
<section class="wishlist-page page-section-ptb">
    <div class="container">
      <div class="row">
          <div class="col-lg-12 col-md-12">
            @include('common.partials.flash')
            <div id="cart-success-remove-message" class="alert alert-success alert-dismissible" style="display: none;" role="alert">
              Product is remove from cart
            </div>
           <div class="table-responsive h-60vh">
              <table class="table">
                <thead>
                    <tr>
                      @if (count($cartPosts))
                      <th>Product</th>
                      <th>Product name</th>
                      <th>Price</th>
                      <th>Quantity </th>
                      <th>Select Size</th>
                      <th>Select Color</th>
                      <th>Stock status </th>
                      <th>Remove </th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($cartPosts as $cartPost)
                        @php
                            $post = $cartPost->post
                        @endphp
                      <tr>
                            <td class="image">
                              <a class="media-link" href="#"> <img class="img-fluid" src="{{ asset('/storage/'. $post->getMetaData('featured_image')) }}" alt=""/></a>
                            </td>
                            <td class="description">
                              <a href="#">{{ $post->title }}</a>
                            </td>
                              @php
                              $discount = round($post->getMetaData('price') - ($post->getMetaData('price') * ($post->getMetaData('discount')/100)));
                              @endphp
                              <td data-id="{{ $cartPost->id }}" id="cartPrice{{ $cartPost->id }}" class="price">
                                {{ $cartPost->price ? $cartPost->price : ($post->getMetaData('discount') ? $discount : $post->getMetaData('price')) }}
                              </td>
                              <td class="td-quentety">
                                  <input id="cart-quantity-max" class="change-quantity" data-id="{{ $post->id }}" data-data="{{ $post->getMetaData('discount') ? $discount : $post->getMetaData('price') }}" type="number" min="0" max="{{ $post->getMetaData('available_small_quantity') }}" value="{{ $cartPost->quantity ? $cartPost->quantity : 1 }}">
                                </td>
                                @if ($post->available_size)
                                <td>
                                    <div class="box">
                                        <select data-id="{{ $cartPost->id }}" class="select-size wide fancyselect" required>
                                            <option value="">Select Size</option>
                                        @foreach (explode(',', $post->available_size) as $size)
                                              <option {{ $size == $cartPost->size ? 'selected' : '' }} value="{{ $size }}">{{ ucfirst($size) }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </td>
                                @else
                                <td>
                                  <select data-id="{{ $cartPost->id }}" class="select-size wide fancyselect" required="required">
                                      <option>Size Not Available</option>
                                    </select>
                                </td>
                                @endif
                                @if ($post->available_colors)
                                <td>
                                    <div class="box">
                                        <select data-id="{{ $cartPost->id }}" class="select-color wide fancyselect" required="required">
                                        <option value="">Select Color</option>
                                        @foreach (explode(',', $post->available_colors) as $color)
                                              <option {{ $color == $cartPost->size ? 'selected' : '' }} value="{{ $color }}">{{ ucfirst($color) }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </td>
                                @else
                                <td><p>Color Not Available</p></td>
                                @endif
                              <td class="price price-2">{{ $post->in_stock == 1 ? 'In Stock' : 'Out of Stock' }}</td>
                              <td class="total">
                              <a data-data="{{ $post->id }}" class="removetocart" href='javascript:;'><i class="fa fa-close"></i></a>
                              </td>
                          </tr>
                      @empty
                      <section class="page-section-ptb">
                        <div class="container">
                          <div class="row justify-content-center">
                            <div class="col-12">
                              <div class="search-no-result text-left text-sm-center clearfix position-relative">
                                <div class="bg-title">
                                  <h2>oops</h2>
                                </div>
                                <div class="search-icon d-inline-block mr-30 mr-sm-40 position-relative theme-color">
                                  <i class="fa fa-frown-o"></i>
                                </div>
                                <div class="search-contant d-inline-block text-left position-relative mt-20 mt-sm-0">
                                  <h2 class="theme-color">Your Cart is Empty</h2>
                                  <div class="error-info mt-30">
                                    <a class="button xs-mb-10" href="{{ route('pages.home') }}">Continue Shopping</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                    @endforelse
                  </tbody>
             </table>
         </div>
       </div>
      </div>
      @if (count($cartPosts))
      <div class="row mt-60">
        <div class="col-md-6">
           <h4>DISCOUNT CODES </h4>
           <p>Enter your coupon code if you have one.</p>
           <div class="form-group">
              <input id="name" type="text" placeholder="Apply Coupon *" class="form-control" name="name">
              <a class="button mt-10" href="#">Apply Coupon</a>
           </div>
        </div>
        <div class="col-md-6 float-right sm-mt-30">
          <table class="table table-dark text-right">
                  <tbody>
                    <tr>
                    <td>Subtotal</td>
                    <td class="totalCartPrice">$ {{ $totalPrice == 0 ? ($post->getMetaData('discount') ? $discount : $post->getMetaData('price')) : $totalPrice }}</td>
                  </tr>
                  <tr class="price">
                    <td><b>Grand Total </b></td>
                    <td class="totalCartPrice"><b>$ {{ $totalPrice == 0 ? ($post->getMetaData('discount') ? $discount : $post->getMetaData('price')) : $totalPrice }} </b></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td><a class="button mt-10" href="{{ route('pages.checkout') }}">Checkout</a></td>
                  </tr>
                </tbody>
              </table>
        </div>
      </div>
      @endif
    </div>
 </section>
 @else
 <section class="page-section-ptb">
     <div class="container">
       <div class="row justify-content-center">
         <div class="col-12">
           <div class="search-no-result text-left text-sm-center clearfix position-relative">
             <div class="bg-title">
               <h2>oops</h2>
             </div>
             <div class="search-icon d-inline-block mr-30 mr-sm-40 position-relative theme-color">
               <i class="fa fa-users"></i>
             </div>
             <div class="search-contant d-inline-block text-left position-relative mt-20 mt-sm-0">
               <h2 class="theme-color">You Need To First Login</h2>
               <div class="error-info mt-30">
                 <a class="button xs-mb-10" href="{{ route('login') }}">Login</a>
                 <a class="button xs-mb-10" href="{{ route('login') }}">Signup</a>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </section>
 @endauth
@endsection
@push('scripts')
    <script src="{{  asset('backend/js/demo_pages/form_layouts.js') }}"></script>
    <script src="{{  asset('backend/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{  asset('backend/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{asset('backend/js/cart-remove.js') }}"></script>
    <script src="{{asset('backend/js/quantity-change-cart.js') }}"></script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $('.select-size').change(function(status){
            var cart_id = this.getAttribute('data-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'get',
                url: "/cart/" + cart_id + "/set-size/" + status.target.value,
                dataType: 'json',
                success:function(data){
                    console.log(data);
                    var quantity = document.getElementById('cart-quantity-max');
                    quantity.setAttribute('max', data);
                }
            });
        });

        $('.select-color').change(function(status){
            var cart_id = this.getAttribute('data-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'get',
                url: "/cart/" + cart_id + "/set-color/" + status.target.value,
                dataType: 'json',
                success:function(data){
                    console.log(data);
                }
            });
        });
    </script>
@endpush
