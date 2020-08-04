@extends('frontend.layouts.layout')

@section('head')
    <title>Checkout | Coco Cart</title>
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

<section class="page-section-ptb">
    <div class="container">
      <div class="row">
        <h2 class="mb-20 text-center" style="width: -webkit-fill-available;">Order details</h2>
      </div>
      <form role="form" method="post" action="{{ route('generate.order') }}">
        @csrf
      <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="section-field mb-30">
                    <label class="mb-10">Full name * </label>
                    <input id="name" type="text" placeholder="Full name *" class="form-control"  name="fullname">
                </div>
                <div class="section-field mb-30">
                    <label class="mb-10">Address * </label>
                    <input type="text" class="not-click form-control mb-10" placeholder="Address 1" value="" name="address">
                </div>
                <div class="section-field mb-30">
                    <label class="mb-10">Phone * </label>
                    <input id="name" type="tel" placeholder="Phone *" class="form-control"  name="phone">
                </div>
                <div class="section-field mb-30">
                  <label class="mb-10">Email * </label>
                  <input id="email" type="email" placeholder="Email *" class="form-control"  name="email">
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="section-field mb-30">
                    <label class="mb-10">city * </label>
                    <input type="text" name="city" placeholder="City *" class="form-control"/>
                </div>
                <div class="section-field mb-30">
                    <label class="mb-10">Postcode / ZIP  </label>
                    <input id="name" type="text" placeholder="Postcode / ZIP" class="form-control"  name="postal_code">
                </div>
                <div class="section-field mb-30">
                    <label class="mb-10">Order notes </label>
                    <textarea class="form-control input-message" placeholder="Note" rows="7" name="message"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
           <div class="col-md-6">
             <table class="table table-responsive">
                <thead>
                <tr>
                  <th>Image</th>
                  <th>Product</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($cartPosts as $cartPost)
                    @php
                        $post = \App\Post::where('id', $cartPost->post_id)->first();
                    @endphp
                    <tr>
                      <td>
                        <div class="product-image">
                          <img class="img-fluid mx-auto" style="width:50px;height:58px;" src="{{ asset('/storage/'. $post->getMetaData('featured_image')) }}">
                        </div>
                      </td>
                      <td><p>{{ $post->title }}</p></td>
                      @php
                      $discount = $post->getMetaData('price') / ($post->getMetaData('discount'));
                      @endphp
                      <td><p>Rs {{ $cartPost->price ? $cartPost->price : ($post->getMetaData('discount') ? $discount : $post->getMetaData('price')) }}</p></td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                  <th>Subtotal</th>
                    <td>
                      <p>Rs {{ $totalPrice == 0 ? ($post->getMetaData('discount') ? $discount : $post->getMetaData('price')) : $totalPrice }}</p>
                    </td>
                </tr>
                <tr>
                   <th>Shipping</th>
                  <td>
                    <div class="clearfix">
                       <label>
                         <span>Free Shipping</span>
                      </label>
                    </div>
                  </td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td><p class="price">Rs {{ $totalPrice == 0 ? ($post->getMetaData('discount') ? $discount : $post->getMetaData('price')) : $totalPrice }}</p></td>
                    </tr>
                </tfoot>
                </table>
           </div>
           <div class="col-md-6">
            <div class="gray-bg  pl-50 pr-50 pt-50 pb-50">
             <table class="mb-30">
                <tbody>
                  <tr>
                   <th class="pl-40"><h3>GRAND TOTAL:</h3> </th>
                   <td class="pl-40"><h3>Rs {{ $totalPrice == 0 ? ($post->getMetaData('discount') ? $discount : $post->getMetaData('price')) : $totalPrice }}</h3></td>
                   </tr>
                  </tbody>
                </table>
                 <input type="submit" class="button btn-block" value="Place Order Now"><span class="icon-action-redo"></span>
               </div>
           </div>
        </div>
    </form>
    </div>
</section>

@endsection
