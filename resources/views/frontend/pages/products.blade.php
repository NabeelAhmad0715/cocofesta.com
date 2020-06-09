@extends('frontend.layouts.layout')

@section('head')
    <title>Products | Coco Cart</title>
    <meta name="description" content="Coco Cart">
    <meta name="keywords" content="Coco Cart">
@endsection

@section('content')

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
                  <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                    <div class="sidebar-widget mb-40">
                      <h5 class="mb-20">search</h5>
                        <div class="widget-search">
                         <i class="fa fa-search"></i>
                         <input type="search" class="form-control placeholder" placeholder="Search Products....">
                       </div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <h5 class="mb-20">Sort By</h5>
                    <select name="sort-price" id="sort-price" class="form-control">
                      <option value="">Popularity</option>
                      <option value="low-to-high">Low To High</option>
                      <option value="high-to-low">High To Low</option>
                  </select>
                  </div>
               </div>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="sidebar-widgets-wrap">
                    <div class="sidebar-widget mb-40">
                    <h5 class="mb-20">categories</h5>
                        <div class="widget-link">
                            <ul>
                               @foreach ($category->children as $category)
                                  <li> <a href="shop-single.html"> <i class="fa fa-angle-double-right"></i> {{ $category->title }} </a></li>
                               @endforeach
                            </ul>
                        </div>
                     </div>
                    <div class="sidebar-widget mb-40">
                    <h5 class="mb-20">Popular items</h5>
                     <div class="recent-item clearfix">
                        <div class="recent-image">
                            <a href="shop-single.html"><img class="img-fluid" src="{{ asset('images/shop/08.jpg') }}" alt=""></a>
                        </div>
                        <div class="recent-info">
                            <div class="recent-title">
                                 <a href="shop-single.html">Product name</a>
                            </div>
                            <div class="recent-meta">
                               <ul class="list-style-unstyled">
                                <li class="color">$29.99 /</li>
                                <li><i class="icon-star3"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i></li>
                            </ul>
                           </div>
                          </div>
                      </div>
                      <div class="recent-item clearfix">
                        <div class="recent-image">
                            <a href="shop-single.html"><img class="img-fluid" src="images/shop/09.jpg" alt=""></a>
                        </div>
                        <div class="recent-info">
                            <div class="recent-title">
                                 <a href="shop-single.html">Product name</a>
                            </div>
                            <div class="recent-meta">
                               <ul class="list-style-unstyled">
                                <li class="color">$29.99 /</li>
                                <li><i class="icon-star3"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i></li>
                            </ul>
                           </div>
                          </div>
                      </div>
                      <div class="recent-item clearfix">
                        <div class="recent-image">
                            <a href="shop-single.html"><img class="img-fluid" src="images/shop/10.jpg" alt=""></a>
                        </div>
                        <div class="recent-info">
                            <div class="recent-title">
                                 <a href="shop-single.html">Product name</a>
                            </div>
                            <div class="recent-meta">
                               <ul class="list-style-unstyled">
                                <li class="color">$29.99 /</li>
                                <li><i class="icon-star3"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i></li>
                            </ul>
                           </div>
                          </div>
                      </div>
                      <div class="recent-item mb-0 clearfix">
                        <div class="recent-image">
                            <a href="shop-single.html"><img class="img-fluid" src="images/shop/11.jpg" alt=""></a>
                        </div>
                        <div class="recent-info">
                            <div class="recent-title">
                                 <a href="shop-single.html">Product name</a>
                            </div>
                            <div class="recent-meta">
                               <ul class="list-style-unstyled">
                                <li class="color">$29.99 /</li>
                                <li><i class="icon-star3"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i></li>
                            </ul>
                           </div>
                          </div>
                      </div>
                    </div>
                    </div>
                </div>
            <div class="col-lg-9 col-md-9">
               <div class="row">
                  @forelse ($categoryPosts as $post)
                  <div class="col-lg-4 col-md-4 col-sm-6">
                        @if ($post->getMetaData('discount') != null)
                              <div class="c-label c-bg-red c-font-uppercase c-font-white c-font-13 c-font-bold">{{ $post->getMetaData('discount') }}% Discount</div>
                        @endif
                        <div class="product mb-70">
                           <a href="{{ route('pages.products',[$post->slug]) }}">
                           <div class="product-image">
                                 <img class="img-fluid mx-auto" src="{{ asset('/storage/'. $post->getMetaData('featured_image')) }}" alt="">
                           </div>
                           <div class="product-des">
                                 <div class="product-title">
                                       <span>{{ $post->title }}</span>
                                 </div>
                                 <div class="product-rating">
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star-half-o"></i>
                                       <i class="fa fa-star-o"></i>
                                 </div>
                                 <div class="product-price">
                                       @if ($post->getMetaData('discount'))
                                             <del>
                                             @php
                                             $price = $post->getMetaData('price');
                                             $discount = $price * ($post->getMetaData('discount')/10);
                                             @endphp
                                             @if ($discount)
                                                   {{ $price }}
                                             @endif
                                             </del>
                                       @endif
                                       <ins>{{ $post->getMetaData('discount') ? $discount : $post->getMetaData('price') }}</ins>
                                 </div>
                                 <div style="margin-top: 10px;">
                                       <span>
                                             <a style="padding: 10px 10px 10px 10px;
                                             background: #007bff;
                                             width: 50%;
                                             text-align: center;
                                             color: white;
                                             float: left;" href="{{ route('pages.whishlist') }}">WHISTLIST</a>
                                       </span>
                                       <span>
                                             <a style="padding: 10px;
                                             background: #84ba3f;
                                             color: white;
                                             float: right;
                                             width: 48%;" data-data="{{ $post->id }}" data-id="{{ $post->getMetaData('discount') ? $discount : $post->getMetaData('price') }}" class="button small addtocart" href='javascript:;'>ADD TO CART</a>
                                       </span>
                                 </div>
                           </div>
                           </a>
                     </div>
                 </div>

                  @empty
                     <h1 class="text-center"> Records Not Found</h1>
                  @endforelse
               </div>
              </div>
            </div>
        </div>
</section>
@endsection