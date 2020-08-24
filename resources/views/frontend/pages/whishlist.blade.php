@extends('frontend.layouts.layout')

@section('head')
    <title>Whishlist | As Fine Leather</title>
    <meta name="description" content="As Fine Leather">
    <meta name="keywords" content="As Fine Leather">
@endsection

@section('content')
{{ session(['link' => url()->current()]) }}
<section class="page-title bg-overlay-black-60 parallax" data-jarallax='{"speed": 0.6}' style="background-image: url({{ asset('images/bg/02.jpg') }});">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="page-title-name">
            <h1>Whishlist</h1>
            <p>We know the secret of your success</p>
          </div>
            <ul class="page-breadcrumb">
              <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>Whishlist </span> </li>
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
              <div id="cart-success-message" class="alert alert-success alert-dismissible" style="display: none;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 Product is added to cart
               </div>
               <div id="cart-danger-message" class="alert alert-danger alert-dismissible" style="display: none;" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  Product is already added to cart
               </div>
              <div id="whishlist-success-remove-message" class="alert alert-success alert-dismissible" style="display: none;" role="alert">
                Product is remove from whishlist
              </div>
              <div class="table-responsive">
                <table class="table">
                  @if (count($whishlistPosts))
                    <thead>
                        <tr>
                          <th>Product</th>
                          <th>Product name</th>
                          <th>Price</th>
                          <th>Add to cart </th>
                          <th>Stock status </th>
                          <th>Close </th>
                        </tr>
                      </thead>
                  @endif
                    <tbody>
                      @forelse ($whishlistPosts as $whishlistPost)
                        @php
                            $post = \App\Post::where('id', $whishlistPost->post_id)->first();
                        @endphp
                        <tr id="whishlistPostsCheck" class="whishlist-post">
                          <td class="image">
                              <a class="media-link" href="#"> <img class="img-fluid" src="{{ asset('/storage/'. $post->getMetaData('featured_image')) }}" alt="{{ $post->getMetaData('title') }}"/></a>
                            </td>
                              <td class="description">
                              <a href="#">{{ $post->title }}</a>
                              </td>
                              <td class="price">{{ $post->getMetaData('price') }}</td>
                              <td class="td-quentety">
                                  <a data-data="{{ $post->id }}" class="button addtocart" href='javascript:;'>Add to cart</a>
                                </td>
                                <td class="price price-2">{{ $post->in_stock == 1 ? 'In Stock' : 'Out of Stock' }}</td>
                              <td class="total">
                                <a data-data="{{ $post->id }}" class="removetowishlist" href='javascript:;'><i class="fa fa-close"></i></a>
                              </td>
                          </tr>
                        @empty
                          <section id="whishlistPostsEmpty"  class="page-section-ptb">
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
                                      <h2 class="theme-color">Your Whishlist is Empty</h2>
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
    <script src="{{asset('backend/js/whishlist-remove.js') }}"></script>
    <script src="{{asset('backend/js/cart-create.js') }}"></script>
@endpush
