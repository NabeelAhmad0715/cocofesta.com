@extends('frontend.layouts.layout')

@section('head')
    <title>{{ $post->getMetaData('meta_title') }}</title>
    <meta name="description" content="{{ $post->getMetaData('meta_description') }}">
    <meta name="keywords" content="{{ $post->getMetaData('meta_keywords') }}">
@endsection

@section('content')
{{ session(['link' => url()->current()]) }}
<section class="page-title bg-overlay-black-60 parallax" data-jarallax='{"speed": 0.6}' style="background-image: url({{ asset('/storage/' . $post->getMetaData('header_image')) }});">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="page-title-name">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->getMetaData('subtitle') }}</p>
          </div>
            <ul class="page-breadcrumb">
              <li><a href="{{ route('pages.home') }}"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><a href="{{ route('pages.products',[$post->type->slug])}}"><i class="fa fa-cart"></i> {{ $post->type->title }}</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>{{ $post->title }}</span> </li>
         </ul>
       </div>
       </div>
    </div>
</section>


<section class="shop-single page-section-pt">
    <div class="container">
      <div class="row">
         <div class="col-lg-9">
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
         <div class="row">
           <div class="col-lg-6">
             <div class="slider-slick">
              <div class="slider slider-for detail-big-car-gallery">
                    @foreach ($post->getMetaData('multiple_thumbnail') as $image)
                        <img class="img-fluid" style="height: 500px;
                    }" src="{{ asset('/storage/'. $image) }}" alt="{{ $post->title }}">
                    @endforeach
                </div>
                <div class="slider slider-nav">
                    @foreach ($post->getMetaData('thumbnails') as $image)
                        <img class="img-fluid" style="height:100px;" src="{{ asset('/storage/'. $image) }}" alt="{{ $post->title }}">
                    @endforeach
                </div>
             </div>
           </div>
           <div class="col-lg-6">
             <div class="product-detail clearfix">
              <div class="product-detail-title mb-20 sm-mt-40" style="display:flex;">
                  <h4 class="mb-10 w-100"> {{ $post->title }}</h4>
                  <ul style="width:60%;">
                    @if ($post->in_stock == 1)
                        <li style="list-style: none;font-size: 20px;text-align: right;color: green;">Available</li>
                    @else
                        <li style="list-style: none;font-size: 20px;text-align: right;color: red;">Out of stock</li>
                    @endif
                  </ul>
              </div>
              <div class="clearfix mb-30">
                <div class="product-detail-price"><span class="text-black" style="font-size:20px"><b>$</b></span>
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
                  <div class="product-detail-rating float-right">
                    <div class='rating-stars'>
                      <ul id='stars'>
                        @isset($totalReviews)
                            @for ($i = 0; $i < $totalReviews; $i++)
                            <li class='starSelected selected'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            @endfor
                            @if ($totalReviews == 4)
                                <li class='starSelected'>
                                <i class='fa fa-star fa-fw'></i>
                                </li>
                            @elseif($totalReviews == 3)
                                <li class='starSelected'>
                                <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='starSelected'>
                                <i class='fa fa-star fa-fw'></i>
                                </li>
                                @elseif($totalReviews == 2)
                                <li class='starSelected'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='starSelected'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='starSelected'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                @elseif($totalReviews == 1)
                                <li class='starSelected'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='starSelected'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='starSelected'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='starSelected'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                @endif
                        @endisset
                      </ul>
                    </div>
                </div>
             </div>
              <div class="product-detail-quantity clearfix mb-40">
                  <div class="product-detail add-to-cart">
                      <a data-data="{{ $post->id }}" data-id="{{ $post->getMetaData('discount') ? ($post->getMetaData('price') - ($post->getMetaData('price') * ($post->getMetaData('discount')/100))) : $post->getMetaData('price') }}" class="@if(!auth()->user())disabled @endif button small addtocart" href='javascript:;'>Add to cart</a>
                  </div>
                    <a style="margin-top:10px;" data-data="{{ $post->id }}" class="@if(!auth()->user())disabled @endif button small addtowishlist" href='javascript:;' >Add to Whishlist</a>
                    @if(!auth()->user())<p class="mt-3" style="color:red"><b>*You Need To First Login</b></p>@endif
                </div>
                <div class="product-detail-des mb-30" style="display:flex;">
                    @if ($post->available_size)
                        <h4>Available Size:</h4>
                        <div class="box dropdown">
                        <select class="fancyselect">
                        @foreach (explode(',', $post->available_size) as $size)
                            <option>{{ ucfirst($size) }}</option>
                        @endforeach
                        </select>
                        </div>
                    @endif
                </div>
                <div class="product-detail-des mb-30">
                    {!! $post->getMetaData('introduction') !!}
             </div>
          </div>
         </div>
         <div class="col-lg-12 col-md-12">

          <div class="tab tab-border mt-50">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active show" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews </a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="description" role="tabpanel" aria-labelledby="description-tab">
                {!! $post->getMetaData('description') !!}
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
              <div class="blog-comments mt-40">
                <div id="review-success-message" class="alert alert-success alert-dismissible" style="display: none;" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   Thank You For Your Feedback :)
                 </div>
                @isset($orderCheck)
                 @if ($orderCheck > $reviewCheck)
                    @isset($reviewCheckUser)
                        @if (count($reviewCheckUser) > 0)
                        <form id="reviewForm" method="post" class="mb-20">
                            <div class="form-group">
                            <label for="Rating">Rating:</label>
                            <div class='rating-stars'>
                                <ul id='stars'>
                                <li class='star' title='Poor' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Fair' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Good' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Excellent' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                </ul>
                            </div>
                            </div>
                            <input type="hidden" id="post_id" value="{{ $post->id }}" />
                            <input type="hidden" id="rating" value="" />
                            <div class="form-group">
                            <label for="Message">Message:</label>
                            <textarea id="reviewMessage" name="message" rows="6" class="form-control" required></textarea>
                            </div>

                            <div class="comments review-button text-right">
                            <input type="submit" class="button" value="Add a Review" />
                            </div>
                        </form>
                        @endif
                    @endisset
                 @endif
                @endisset
                    @forelse ($post->reviews as $review)
                      <input type="hidden" value="{{ $review->rating }}" id="rating-star"/>
                          <div class="comments-1">
                              <div class="comments-info w-100">
                                  <h6> {{ $review->user->name }} <span id="date">{{ date('d M Y', strtotime($review->created_at)) }}</span></h6>
                                  <div class='rating-stars'>
                                    <ul id='stars'>
                                      @for ($i = 0; $i < $review->rating; $i++)
                                        <li class='starSelected selected'>
                                          <i class='fa fa-star fa-fw'></i>
                                        </li>
                                      @endfor
                                      @if ($review->rating == 4)
                                        <li class='starSelected'>
                                          <i class='fa fa-star fa-fw'></i>
                                        </li>
                                      @elseif($review->rating == 3)
                                        <li class='starSelected'>
                                          <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='starSelected'>
                                          <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        @elseif($review->rating == 2)
                                          <li class='starSelected'>
                                            <i class='fa fa-star fa-fw'></i>
                                          </li>
                                          <li class='starSelected'>
                                            <i class='fa fa-star fa-fw'></i>
                                          </li>
                                          <li class='starSelected'>
                                            <i class='fa fa-star fa-fw'></i>
                                          </li>
                                        @elseif($review->rating == 1)
                                          <li class='starSelected'>
                                            <i class='fa fa-star fa-fw'></i>
                                          </li>
                                          <li class='starSelected'>
                                            <i class='fa fa-star fa-fw'></i>
                                          </li>
                                          <li class='starSelected'>
                                            <i class='fa fa-star fa-fw'></i>
                                          </li>
                                          <li class='starSelected'>
                                            <i class='fa fa-star fa-fw'></i>
                                          </li>
                                        @endif
                                    </ul>
                                  </div>
                                  <p id="review">{{ $review->message }}</p>
                              </div>
                          </div>
                      @empty
                          <h2>No Reviews yet</h2>
                      @endforelse
                    </div>
                  </div>
                </div>
            </div>
           </div>
       </div>
       </div>
       <div class="col-lg-3">
           <div class="sidebar-widgets-wrap">
            <form method="GET" action="{{ route('pages.search',[$type->slug]) }}">
               <div class="sidebar-widget mb-40">
                   <h5 class="mb-20">Search</h5>
                     <div class="widget-search">
                     <i class="fa fa-search"></i>
                     <input type="search" name="search" class="form-control placeholder" placeholder="Search Products....">
                   </div>
                 </div>
            </form>
                <div class="sidebar-widget mb-0">
                <h5 class="mb-20">Popular items</h5>
                @forelse ($topRatedPosts as $topRatedPost)
                 <div class="recent-item clearfix">
                    <div class="recent-image">
                        <a href="shop-single.html"><img style="height: 50px;" class="img-fluid" src="{{ asset('/storage/'. $topRatedPost->post->getMetaData('featured_image')) }}" alt=""></a>
                    </div>
                    <div class="recent-info">
                        <div class="recent-title">
                             <a href="shop-single.html">{{ $topRatedPost->post->title }}</a>
                        </div>
                        <div class="recent-meta">
                           <ul class="list-style-unstyled">
                            <li class="color">$ {{ $topRatedPost->post->getMetaData('price') - ($topRatedPost->post->getMetaData('price') * ($topRatedPost->post->getMetaData('discount')/100)) }} /</li>
                            <li>
                            @php
                            $star = round(number_format((float) ($topRatedPost->post->reviews->sum('rating') / $topRatedPost->post->reviews->count()), 2, '.', ''));
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
      </div>
    </div>
 </section>

<section class="page-section-ptb gray-bg">
    <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="section-title text-center">
             <h6>We want to create a range of beautiful</h6>
             <h2 class="title-effect">Related Products</h2>
           </div>
        </div>
     </div>
     <div class="row">
        @forelse ($relatedPosts as $post)
         <div class="col-lg-4 col-md-4 mb-30">
            <div class="listing-post">

                  <div class="blog-overlay">

                        <div class="blog-image">
                              <img class="img-fluid" style="width: 500px;height:200px;" src="{{ asset('/storage/'. $post->getMetaData('featured_image')) }}" alt="{{ $post->title }}">
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
                  <a class="popup portfolio-img" href="{{ asset('/storage/'. $post->getMetaData('featured_image')) }}"><i class="fa fa-arrows-alt"></i></a>
              <div class="listing-post-info">
                <div class="listing-post-meta clearfix">
                     <ul class="list-unstyled d-inline-block" style="padding: 5px 15px;">
                        <li>
                              <div class="product-price">
                                    <span class="text-black" style="font-size:20px"><b>$</b></span>
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
      </div>
      </div>
</section>
@endsection
@push('scripts')
    <script src="{{  asset('backend/js/demo_pages/form_layouts.js') }}"></script>
    <script src="{{  asset('backend/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{  asset('backend/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{asset('backend/js/whishlist-create.js') }}"></script>
    <script src="{{asset('backend/js/cart-create.js') }}"></script>
    <script src="{{asset('backend/js/reviews.js') }}"></script>
@endpush
