@extends('frontend.layouts.layout')

@section('head')
    <title>Homepage | Coco Cart</title>
    <meta name="description" content="Coco Cart">
    <meta name="keywords" content="Coco Cart">
@endsection

@section('content')
{{ session(['link' => url()->current()]) }}
<section class="rev-slider">
    <div id="rev_slider_266_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="webster-shop-2" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
  <!-- START REVOLUTION SLIDER 5.4.6.3 fullwidth mode -->
    <div id="rev_slider_266_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.6.3">
  <ul>  <!-- SLIDE  -->
      <li data-index="rs-753" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb="{{ asset('images/slider/01.jpg')}}"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
      <!-- MAIN IMAGE -->
          <img src="{{ asset('images/slider/01.jpg')}}"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
      <!-- LAYERS -->

      <!-- LAYER NR. 1 -->
      <div class="tp-caption   tp-resizeme"
         id="slide-753-layer-1"
         data-x="393"
         data-y="center" data-voffset="-102"
              data-width="['auto']"
        data-height="['auto']"

              data-type="text"
        data-responsive_offset="on"

              data-frames='[{"delay":10,"speed":2000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
              data-textAlign="['inherit','inherit','inherit','inherit']"
              data-paddingtop="[0,0,0,0]"
              data-paddingright="[0,0,0,0]"
              data-paddingbottom="[0,0,0,0]"
              data-paddingleft="[0,0,0,0]"

              style="z-index: 5; white-space: nowrap; font-size: 24px; line-height: 24px; font-weight: 400; color: #ffffff; letter-spacing: 3px;font-family:Montserrat;">NEW COLLECTION </div>

      <!-- LAYER NR. 2 -->
      <div class="tp-caption   tp-resizeme"
         id="slide-753-layer-2"
         data-x="391"
         data-y="385"
              data-width="['auto']"
        data-height="['auto']"

              data-type="text"
        data-responsive_offset="on"

              data-frames='[{"delay":1360,"split":"chars","splitdelay":0.1,"speed":2000,"split_direction":"forward","frame":"0","from":"x:[-105%];z:0;rX:0deg;rY:0deg;rZ:-90deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
              data-textAlign="['inherit','inherit','inherit','inherit']"
              data-paddingtop="[0,0,0,0]"
              data-paddingright="[0,0,0,0]"
              data-paddingbottom="[0,0,0,0]"
              data-paddingleft="[0,0,0,0]"

              style="z-index: 6; white-space: nowrap; font-size: 90px; line-height: 90px; font-weight: 700; color: #ffffff; letter-spacing: 0px;font-family:Montserrat;">AS FINE </div>

      <!-- LAYER NR. 3 -->
      <div class="tp-caption   tp-resizeme"
         id="slide-753-layer-3"
         data-x="393"
         data-y="474"
              data-width="['auto']"
        data-height="['auto']"

              data-type="text"
        data-responsive_offset="on"

              data-frames='[{"delay":2760,"split":"chars","splitdelay":0.05,"speed":2000,"split_direction":"forward","frame":"0","from":"x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
              data-textAlign="['inherit','inherit','inherit','inherit']"
              data-paddingtop="[0,0,0,0]"
              data-paddingright="[0,0,0,0]"
              data-paddingbottom="[0,0,0,0]"
              data-paddingleft="[0,0,0,0]"

              style="z-index: 7; white-space: nowrap; font-size: 90px; line-height: 90px; font-weight: 700; color: #ffffff; letter-spacing: 0px;font-family:Montserrat;">LEATHER </div>

      <!-- LAYER NR. 4 -->
      <div class="tp-caption   tp-resizeme"
         id="slide-753-layer-4"
         data-x="393"
         data-y="589"
              data-width="['auto']"
        data-height="['auto']"

              data-type="text"
        data-responsive_offset="on"

              data-frames='[{"delay":4270,"split":"chars","splitdelay":0.05,"speed":2000,"split_direction":"forward","frame":"0","from":"y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
              data-textAlign="['inherit','inherit','inherit','inherit']"
              data-paddingtop="[0,0,0,0]"
              data-paddingright="[0,0,0,0]"
              data-paddingbottom="[0,0,0,0]"
              data-paddingleft="[0,0,0,0]"

              style="z-index: 8; white-space: nowrap; font-size: 54px; line-height: 54px; font-weight: 600; color: #ffffff; letter-spacing: 0px;font-family:Poppins;">ENJOY UP TO 50% OFF </div>

      <!-- LAYER NR. 5 -->
      <a class="tp-caption rev-btn  tp-resizeme"
   href="#" target="_self"       id="slide-753-layer-5"
         data-x="393"
         data-y="691"
              data-width="['auto']"
        data-height="['auto']"

              data-type="button"
        data-actions=''
        data-responsive_offset="on"

              data-frames='[{"delay":5950,"speed":2000,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"500","ease":"Power0.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(255,255,255);bg:rgb(10,10,10);bs:solid;bw:0 0 0 0;"}]'
              data-textAlign="['inherit','inherit','inherit','inherit']"
              data-paddingtop="[12,12,12,12]"
              data-paddingright="[35,35,35,35]"
              data-paddingbottom="[12,12,12,12]"
              data-paddingleft="[35,35,35,35]"

              style="z-index: 9; white-space: nowrap; font-size: 17px; line-height: 17px; font-weight: 500; color: #0a0a0a; font-family:Roboto;background-color:rgb(255,255,255);border-color:rgba(0,0,0,1);border-radius:3px 3px 3px 3px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;text-decoration: none;">BUY NOW! </a>
    </li>
    <!-- SLIDE  -->
      <li data-index="rs-754" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb="{{ asset('images/slider/02.jpg')}}"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
      <!-- MAIN IMAGE -->
          <img src="{{ asset('images/slider/02.jpg')}}"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
      <!-- LAYERS -->

      <!-- LAYER NR. 6 -->
      <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme"
         id="slide-754-layer-7"
         data-x="1122"
         data-y="260"
              data-width="['50']"
        data-height="['3']"

              data-type="shape"
        data-responsive_offset="on"

              data-frames='[{"delay":10,"speed":2000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
              data-textAlign="['inherit','inherit','inherit','inherit']"
              data-paddingtop="[0,0,0,0]"
              data-paddingright="[0,0,0,0]"
              data-paddingbottom="[0,0,0,0]"
              data-paddingleft="[0,0,0,0]"

              style="z-index: 5;background-color:rgb(255,255,255);"> </div>

      <!-- LAYER NR. 7 -->
      <div class="tp-caption   tp-resizeme"
         id="slide-754-layer-1"
         data-x="1191"
         data-y="center" data-voffset="-190"
              data-width="['auto']"
        data-height="['auto']"

              data-type="text"
        data-responsive_offset="on"

              data-frames='[{"delay":650,"speed":2000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
              data-textAlign="['inherit','inherit','inherit','inherit']"
              data-paddingtop="[0,0,0,0]"
              data-paddingright="[0,0,0,0]"
              data-paddingbottom="[0,0,0,0]"
              data-paddingleft="[0,0,0,0]"

              style="z-index: 6; white-space: nowrap; font-size: 36px; line-height: 36px; font-weight: 600; color: #ffffff; letter-spacing: 3px;font-family:Montserrat;">SPECIAL OFFER </div>

      <!-- LAYER NR. 8 -->
      <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme"
         id="slide-754-layer-8"
         data-x="1530"
         data-y="259"
              data-width="['50']"
        data-height="['3']"

              data-type="shape"
        data-responsive_offset="on"

              data-frames='[{"delay":1120,"speed":2000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
              data-textAlign="['inherit','inherit','inherit','inherit']"
              data-paddingtop="[0,0,0,0]"
              data-paddingright="[0,0,0,0]"
              data-paddingbottom="[0,0,0,0]"
              data-paddingleft="[0,0,0,0]"

              style="z-index: 7;background-color:rgb(255,255,255);"> </div>

      <!-- LAYER NR. 9 -->
      <div class="tp-caption   tp-resizeme"
         id="slide-754-layer-2"
         data-x="right" data-hoffset="390"
         data-y="297"
              data-width="['auto']"
        data-height="['auto']"

              data-type="text"
        data-responsive_offset="on"

              data-frames='[{"delay":1360,"split":"chars","splitdelay":0.1,"speed":2000,"split_direction":"forward","frame":"0","from":"x:[-105%];z:0;rX:0deg;rY:0deg;rZ:-90deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
              data-textAlign="['inherit','inherit','inherit','inherit']"
              data-paddingtop="[0,0,0,0]"
              data-paddingright="[0,0,0,0]"
              data-paddingbottom="[0,0,0,0]"
              data-paddingleft="[0,0,0,0]"

              style="z-index: 8; white-space: nowrap; font-size: 120px; line-height: 120px; font-weight: 700; color: #ffffff; letter-spacing: 0px;font-family:Montserrat;">UP TO </div>

      <!-- LAYER NR. 10 -->
      <div class="tp-caption   tp-resizeme"
         id="slide-754-layer-3"
         data-x="right" data-hoffset="294"
         data-y="405"
              data-width="['auto']"
        data-height="['auto']"

              data-type="text"
        data-responsive_offset="on"

              data-frames='[{"delay":2760,"split":"chars","splitdelay":0.05,"speed":2000,"split_direction":"forward","frame":"0","from":"x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
              data-textAlign="['inherit','inherit','inherit','inherit']"
              data-paddingtop="[0,0,0,0]"
              data-paddingright="[0,0,0,0]"
              data-paddingbottom="[0,0,0,0]"
              data-paddingleft="[0,0,0,0]"

              style="z-index: 9; white-space: nowrap; font-size: 120px; line-height: 120px; font-weight: 700; color: #ffffff; letter-spacing: 0px;font-family:Montserrat;text-transform:uppercase;">80% oFF </div>

      <!-- LAYER NR. 11 -->
      <div class="tp-caption   tp-resizeme"
         id="slide-754-layer-4"
         data-x="right" data-hoffset="385"
         data-y="537"
              data-width="['auto']"
        data-height="['auto']"

              data-type="text"
        data-responsive_offset="on"

              data-frames='[{"delay":4270,"split":"chars","splitdelay":0.05,"speed":2000,"split_direction":"forward","frame":"0","from":"y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
              data-textAlign="['inherit','inherit','inherit','inherit']"
              data-paddingtop="[0,0,0,0]"
              data-paddingright="[0,0,0,0]"
              data-paddingbottom="[0,0,0,0]"
              data-paddingleft="[0,0,0,0]"

              style="z-index: 10; white-space: nowrap; font-size: 36px; line-height: 36px; font-weight: 600; color: #ffffff; letter-spacing:      px;font-family:Poppins;text-transform:uppercase;">lIMITED tIME ONLY ! </div>

      <!-- LAYER NR. 12 -->
      <a class="tp-caption rev-btn  tp-resizeme"
   href="#" target="_self"       id="slide-754-layer-5"
         data-x="right" data-hoffset="494"
         data-y="604"
              data-width="['auto']"
        data-height="['auto']"

              data-type="button"
        data-actions=''
        data-responsive_offset="on"

              data-frames='[{"delay":5950,"speed":2000,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"500","ease":"Power0.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(255,255,255);bg:rgb(10,10,10);bs:solid;bw:0 0 0 0;"}]'
              data-textAlign="['inherit','inherit','inherit','inherit']"
              data-paddingtop="[12,12,12,12]"
              data-paddingright="[35,35,35,35]"
              data-paddingbottom="[12,12,12,12]"
              data-paddingleft="[35,35,35,35]"

              style="z-index: 11; white-space: nowrap; font-size: 17px; line-height: 17px; font-weight: 500; color: #0a0a0a; font-family:Roboto;background-color:rgb(255,255,255);border-color:rgba(0,0,0,1);border-radius:3px 3px 3px 3px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;text-decoration: none;">BUY NOW! </a>
    </li>
  </ul>
  <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div> </div>
  </div>
</section>
<section class="page-section-ptb gray-bg" >
      <div class="container">
       <div class="row justify-content-center">
         <div class="col-lg-8">
           <div class="section-title text-center">
           <h2>New  <span class="theme-color"> Collections </span>  </h2>
           <p>You will sail along until you collide with an immovable object, after which you will sink to the bottom</p>
          </div>
          <div id="whishlist-success-message" class="alert alert-success alert-dismissible" style="display: none;" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             Product is added to whishlist
           </div>
           <div id="whishlist-danger-message" class="alert alert-danger alert-dismissible" style="display: none;" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              Product is already added to whishlist
           </div>
           <div id="cart-success-message" class="alert alert-success alert-dismissible" style="display: none;" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             Product is added to cart
           </div>
           <div id="cart-danger-message" class="alert alert-danger alert-dismissible" style="display: none;" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              Product is already added to cart
           </div>
         </div>
       </div>
       <div class="row popup-gallery">
        @forelse ($latestPosts as $post)
         <div class="col-lg-4 col-md-6 mb-30">
            <div class="listing-post">
                  <a class="popup portfolio-img" href="{{ asset('/storage/'. $post->getMetaData('featured_image')) }}"><i class="fa fa-arrows-alt"></i></a>
                  <div class="blog-overlay">

                        <div class="blog-image">
                              <img class="img-fluid" src="{{ asset('/storage/'. $post->getMetaData('featured_image')) }}" alt="{{ $post->title }}">
                        </div>
                        @if ($post->getMetaData('discount'))
                        <div class="blog-icon clearfix">
                              <span class="date float-left bg-danger">Discount {{ $post->getMetaData('discount') }}%</span>
                        </div>
                        @endif
                        <div class="blog-name clearfix pl-20">
                            @if ($post->reviews->count() != 0)
                                  <div class="blog-name-left bg-info">
                                    <span>
                                    {{ round(number_format((float) ($post->reviews->sum('rating') / $post->reviews->count()), 2, '.', '')) }}</span>
                                </div>
                            @endif
                              <a href="#">
                                    <div class="blog-name-right" style="padding: 12px 0px 0px 0px;">
                                          <h4 class="text-white"><a href="{{ route('pages.product-post', [$post->type->slug,$post->slug] ) }}">{{ $post->title }}</a></h4>
                                    </div>
                              </a>
                        </div>
                  </div>
              <div class="listing-post-info">
                <div class="listing-post-meta clearfix">
                     <ul class="list-unstyled d-inline-block" style="padding: 5px 15px;">
                        <li>
                              <div class="product-price">
                                    <span class="text-black" style="font-size:20px"><b>PKR.</b></span>
                                    @if ($post->getMetaData('discount'))
                                                <del>
                                                @php
                                                $price = $post->getMetaData('price');
                                                $discount = $price - ($price * ($post->getMetaData('discount')/100));
                                                @endphp
                                                @if ($discount)
                                                      {{ $price }}
                                                @endif
                                                </del>
                                          @endif
                                          <ins>{{ $post->getMetaData('discount') ? round($discount) : $post->getMetaData('price') }}</ins>
                              </div>
                        </li>
                     </ul>
                     <div class="float-right">
                       <h6 class="theme-color">
                        <a data-data="{{ $post->id }}" data-id="{{ $post->getMetaData('discount') ? $discount : $post->getMetaData('price') }}" class="@if(!auth()->user())disabled @endif addtocart" href='javascript:;'>Add to cart</a>
                    </h6>
                     </div>
                 </div>
                 @if(!auth()->user())<p class="text-right mt-3" style="color:red"><b>*You Need To First Login</b></p>@endif
              </div>
          </div>
         </div>
         @empty
         <div class="w-100">
             <h2 class="text-center">No New Collections</h2>
         </div>
         @endforelse
         <div class="w-100 text-center">
          <a class="button ml-10" href="{{ route('pages.products',[$type->slug]) }}">Explore All</a>
         </div>
       </div>
     </div>
</section>

<section class="shop-block page-section-ptb bg-overlay-black-40 parallax" data-jarallax='{"speed": 0.6}' style="background-image: url({{ asset('images/05.jpg') }});">
    <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-10 text-center pt-50 pb-50">
        <h2 class="text-white">Women’s lookbook </h2>
          <p class="text-white mt-20 mb-30">Best Watches available on the cheapest prices at Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
           <a class="button white button-border" href="#">Shop Now </a>
           <a class="button white ml-10" href="#">Get deale</a>
       </div>
      </div>
    </div>
</section>

<section class="page-section-ptb">
      <div class="container">
         <div class="row">
          <div class="col-lg-4 col-sm-6">
            <h4 class="mb-30">Top Rated</h4>
            @forelse ($topRatedPosts as $post)
                @php
                    $post = $post->post;
                @endphp
                <div class="product left clearfix mb-40">
                    <div class="product-image">
                        <a href="#"><img class="img-fluid mx-auto" alt="{{ $post->title }}" style="height: 88px;" src="{{ asset('/storage/'. $post->getMetaData('featured_image')) }}">
                        </a>
                    </div>
                    <div class="product-description">
                        <div class="product-title">
                            <h5> <a href="#"> {{ $post->title }} </a> </h5>
                        </div>
                        <div class="product-price">
                            <span class="text-black" style="font-size:10px"><b>PKR.</b></span>
                            @if ($post->getMetaData('discount'))
                                        <del>
                                        @php
                                        $price = $post->getMetaData('price');
                                        $discount = $price - ($price * ($post->getMetaData('discount')/100));
                                        @endphp
                                        @if ($discount)
                                              {{ $price }}
                                        @endif
                                        </del>
                                  @endif
                                  <ins>{{ $post->getMetaData('discount') ? round($discount) : $post->getMetaData('price') }}</ins>
                      </div>
                        <div class="product-rate">
                            @php
                                $star = round(number_format((float) ($post->reviews->sum('rating') / $post->reviews->count()), 2, '.', ''));
                            @endphp
                            @for ($i = 0; $i < $star; $i++)
                                <i style="color:#FFCC36" class='fa fa-star fa-fw'></i>
                            @endfor
                            @if ($star == 4)
                                <i class='fa fa-star-o'></i>
                            @elseif($star == 3)
                                <i class='fa fa-star-o'></i>
                                <i class='fa fa-star-o'></i>
                            @elseif($star == 2)
                                <i class='fa fa-star-o'></i>
                                <i class='fa fa-star-o'></i>
                                <i class='fa fa-star-o'></i>
                            @elseif($star == 1)
                                <i class='fa fa-star-o'></i>
                                <i class='fa fa-star-o'></i>
                                <i class='fa fa-star-o'></i>
                                <i class='fa fa-star-o'></i>
                            @endif
                        </div>
                    </div>
            </div>
            @empty
            <div class="w-100">
                <h2 class="text-center">No post top rated</h2>
            </div>
            @endforelse
          </div>
          <div class="col-lg-4 col-sm-6">
            <h4 class="mb-30 xs-mt-30">Popular</h4>
            @forelse ($popularPosts as $popular)
                @php
                    $post = $popular->post;
                @endphp
                <div class="product left clearfix mb-40">
                    <div class="product-image">
                        <a href="#"><img class="img-fluid mx-auto" alt="{{ $post->title }}" style="height: 88px;" src="{{ asset('/storage/'. $post->getMetaData('featured_image')) }}">
                        </a>
                    </div>
                    <div class="product-description">
                        <div class="product-title">
                            <h5> <a href="#"> {{ $post->title }} </a> </h5>
                        </div>
                        <div class="product-price">
                            <span class="text-black" style="font-size:10px"><b>PKR.</b></span>
                            @if ($post->getMetaData('discount'))
                                        <del>
                                        @php
                                        $price = $post->getMetaData('price');
                                        $discount = $price - ($price * ($post->getMetaData('discount')/100));
                                        @endphp
                                        @if ($discount)
                                              {{ $price }}
                                        @endif
                                        </del>
                                  @endif
                                  <ins>{{ $post->getMetaData('discount') ? round($discount) : $post->getMetaData('price') }}</ins>
                      </div>
                        <div class="product-rate">
                            @if ($popular->post->reviews->count())
                                @php
                                    $popularStar = round(number_format((float) ($popular->post->reviews->sum('rating') / $popular->post->reviews->count()), 2, '.', ''));
                                @endphp
                                @for ($i = 0; $i < round($popularStar); $i++)
                                    <i style="color:#FFCC36" class='fa fa-star fa-fw'></i>
                                @endfor
                                @if ($popularStar == 4)
                                    <i class='fa fa-star-o'></i>
                                @elseif($popularStar == 3)
                                    <i class='fa fa-star-o'></i>
                                    <i class='fa fa-star-o'></i>
                                @elseif($popularStar == 2)
                                    <i class='fa fa-star-o'></i>
                                    <i class='fa fa-star-o'></i>
                                    <i class='fa fa-star-o'></i>
                                @elseif($popularStar == 1)
                                    <i class='fa fa-star-o'></i>
                                    <i class='fa fa-star-o'></i>
                                    <i class='fa fa-star-o'></i>
                                    <i class='fa fa-star-o'></i>
                                @endif

                            @endif
                        </div>
                    </div>
            </div>
            @empty
            <div class="w-100">
                <h2 class="text-center">No post top rated</h2>
            </div>
            @endforelse
          </div>
          <div class="col-lg-4">
             <div class="offer-banner-1 text-center sm-mt-40">
            <div class="banner-image">
             <div class="line-effect">
              <img class="img-fluid" src="{{ asset('images/06.jpg') }}" alt="">
              <div class="overlay"></div>
             </div>
            </div>
            <div class="banner-content">
              <h1 class="text-uppercase text-white">Discount !</h1>
              <strong>Having more than 1000+ New Exclusive Men & Women products</strong>
              <a class="button" href="#">view more <i class="fa fa-angle-right"></i></a>
            </div>
         </div>
          </div>
       </div>
     </div>
</section>

<section class="black-bg pt-50 pb-50">
      <div class="container">
            <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="feature-text">
                  <div class="feature-icon">
                  <span class="ti-loop theme-color"></span>
            </div>
            <div class="feature-info">
                  <h4 class="text-white">Return & Exchange</h4>
                  <p class="text-white">Dolor sit consectetur conseqt.</p>
            </div>
            </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="feature-text">
                  <div class="feature-icon">
                  <span class="ti-gift theme-color"></span>
            </div>
            <div class="feature-info">
                  <h4 class="text-white">Receive Gift cards</h4>
                  <p class="text-white">Dolor sit consectetur conseqt , enim.</p>
            </div>
            </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="feature-text">
                  <div class="feature-icon">
                  <span class="ti-user theme-color"></span>
                  </div>
                  <div class="feature-info">
                  <h4 class="text-white">Online Support</h4>
                  <p class="text-white">Dolor sit consectetur conseqt.</p>
                  </div>
            </div>
            </div>
            </div>
      </div>
</section>
@endsection
@push('scripts')
    <script src="{{asset('backend/js/whishlist-create.js') }}"></script>
    <script src="{{asset('backend/js/cart-create.js') }}"></script>
    <script src="{{asset('backend/js/reviews.js') }}"></script>
@endpush
