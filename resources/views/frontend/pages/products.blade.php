@extends('frontend.layouts.layout')

@section('head')
    <title>Products | Coco Cart</title>
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
            <h1>Products</h1>
            <p>We know the secret of your success</p>
          </div>
            <ul class="page-breadcrumb">
              <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><a href="#">page</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>Products</span> </li>
         </ul>
       </div>
       </div>
    </div>
</section>


<section class="shop grid page-section-ptb">
        <div class="container">
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form method="GET" action="{{ route('pages.search',[$type->slug]) }}">
                    <div class="sidebar-widget mb-40">
                      <h5 class="mb-20">search</h5>
                        <div class="widget-search">
                         <i class="fa fa-search"></i>
                         <input type="search" name="search" class="form-control placeholder" placeholder="Search Products....">
                       </div>
                     </div>
                    </form>
                  </div>
               </div>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="sidebar-widgets-wrap">
                    <div class="sidebar-widget mb-40">
                    <h5 class="mb-20">categories</h5>
                        <div class="widget-link">
                            <ul>
                               {{-- @foreach ($category->children as $category)
                                  <li> <a href="shop-single.html"> <i class="fa fa-angle-double-right"></i> {{ $category->title }} </a></li>
                               @endforeach --}}
                            </ul>
                        </div>
                     </div>
                    <div class="sidebar-widget mb-40">
                    <h5 class="mb-20">Popular items</h5>
                    @forelse ($topRatedPosts as $post)
                    @php
                        $post = $post->post;
                    @endphp
                     <div class="recent-item clearfix">
                        <div class="recent-image">
                            <a href="shop-single.html"><img style="height: 50px;" class="img-fluid" src="{{ asset('/storage/'. $post->getMetaData('featured_image')) }}" alt=""></a>
                        </div>
                        <div class="recent-info">
                            <div class="recent-title">
                                 <a href="shop-single.html">{{ $post->title }}</a>
                            </div>
                            <div class="recent-meta">
                               <ul class="list-style-unstyled">
                                <li class="color">PKR. {{ round($post->getMetaData('price') / $post->getMetaData('discount')) }} /</li>
                                <li>
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
                                </li>
                            </ul>
                           </div>
                        </div>
                      </div>
                      @empty
                      <div class="w-100">
                          <h2 class="text-center">No post top rated</h2>
                      </div>
                      @endforelse
                    </div>
                    </div>
                </div>
            <div class="col-lg-9 col-md-9">
               <div class="row">
                  @forelse ($records as $post)
                  <div class="col-lg-6 col-md-6 mb-30">
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
                      <div class="listing-post-info" style="background:#f7f7f7 !important;">
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
                    <h2 class="text-center">Records Not Found</h2>
                  </div>
                  @endforelse
               </div>
              </div>
            </div>
        </div>
</section>
@endsection
