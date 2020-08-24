@extends('frontend.layouts.layout')

@section('head')
    <title>Thank You | AS Fine Leather</title>
    <meta name="description" content="AS Fine Leather">
    <meta name="keywords" content="AS Fine Leather">
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
@isset($orderPosts)
@if (count($orderPosts) > 0)
<section class="page-section-ptb">
    <div class="container">
      @include('common.partials.flash')
        <div class="row">
            <div class="col-md-12">
                <div class="pricing-table">
                    <div class="pricing-top thankyou-box">
                      <div class="pricing-title">
                        <h3 class="mb-15 text-center">CHECKOUT COMPLETED</h3>
                      </div>
                      <div class="c-theme-bg">
                            <p class="c-message text-center text-white">
                                <i class="fa fa-check"></i> Thank you. Your order has been received. </p>
                        </div>
                        <div class="order-details w-100">
                            <ul>
                                <li>
                                    <h4>Order Number</h4>
                                    <p>#{{ $orderPosts[0]->order_number }}</p>
                                </li>
                                <li>
                                    <h4>Date Purchased</h4>
                                    <p>{{ date('F d, Y', strtotime($orderPosts[0]->created_at)) }}</p>
                                </li>
                                <li>
                                    <h4>Total Payable</h4>
                                    <p>${{ $orderPosts->sum('price') }}</p>
                                </li>
                            </ul>
                        </div>
                        <div class="list-posts mt-5">
                            <div class="row mb-5">
                                <div class="col-md-4">
                                    <h4 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold text-center">Product</h4>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold text-center">Description</h4>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold text-center">Total</h4>
                                </div>
                            </div>
                            @foreach ($orderPosts as $order)
                            <div class="row mb-5">
                                <div class="col-md-4">
                                    <img class="img-fluid" src="{{ asset('/storage/'. $order->post->getMetaData('featured_image'))}}"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="description-details text-center">
                                        <h3 class="theme-color">{{ $order->post->title }}</h3>
                                        <p><b>Qunatity:</b> {{ $order->quantity }}</p>
                                        <p><b>Size:</b> {{ $order->size }}</p>
                                        <p><b>Color:</b> {{ $order->color }}</p>
                                        @if($order->status == 0)
                                        <p><b>Status:</b> <span class="badge badge-primary" style="padding:7px;">Pending</span></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4>${{ $order->price }}</h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="billing-address">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <h4><b>Customer Details</b></h4>
                                    <ul class="list-unstyled">
                                        <li>Name: {{ $orderPosts[0]->order->fullname }}</li>
                                        <li>Phone: {{ $orderPosts[0]->order->phone }}</li>
                                        <li>Email:
                                            <a href="mailto:{{ $orderPosts[0]->order->email }}" class="c-theme-color">{{ $orderPosts[0]->order->email }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4><b>Billing Address</b></h4>
                                    <p>{{ $orderPosts[0]->order->address }}
                                    </p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4><b>Grand Total</b></h4>
                                    <p>${{ $orderPosts->sum('price') }}</p>
                                </div>
                            </div>
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
@endisset
@endsection
