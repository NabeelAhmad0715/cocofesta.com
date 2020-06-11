@extends('frontend.layouts.layout')

@section('head')
    <title>Thank You | Coco Cart</title>
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
            <h1>Shop checkout</h1>
            <p>We know the secret of your success</p>
          </div>
            <ul class="page-breadcrumb">
              <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><a href="#">Shop</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>Shop checkout </span> </li>
         </ul>
       </div>
       </div>
    </div>
</section>

@if (count($cartPosts) <= 0)
    <section class="white-bg page-section-ptb">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
            <div class="section-title text-center">
                <h2 class="title-effect">Thank You For Your Purchase</h2>
                <p> Your order has been received. Please keep me in mind for future shooping.</p>
            </div>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                <div class="coming-soon-form contact-form text-center clearfix mt-30">
                    <div id="mc_embed_signup_scroll">

                        <div class="clear">
                        <a name="submitbtn" style="padding: 10px;
                        background: #84ba3f;
                        color: white;
                        width: 50%;" href="{{ route('pages.home') }}" class="a button-border mt-20 form-button">  Continue Shopping </a>
                        </div>
                    </div>
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
              <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="search-contant d-inline-block text-left position-relative mt-20 mt-sm-0">
              <h2 class="theme-color">You Need To First Place Order</h2>
              <div class="error-info mt-30">
                <a class="button xs-mb-10" href="{{ route('pages.home') }}">Contiune Shopping</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endif

@endsection