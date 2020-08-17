@extends('frontend.layouts.layout')

@section('head')
    <title>{{ $type->meta_title }}</title>
    <meta name="description" content="{{ $type->meta_description }}">
    <meta name="keywords" content="{{ $type->meta_keywords }}">
@endsection

@section('content')
{{ session(['link' => url()->current()]) }}
<section class="page-title bg-overlay-black-60 parallax" data-jarallax='{"speed": 0.6}' style="@if(count($type->images('header')) > 0)background-image:url({{ asset('/storage/' . $type->images('header')[0]->name) }});@else background-image:url({{ asset('/frontend/images/index/image/deselect.jpg') }} )@endif">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="page-title-name">
            <h1>{{ $type->title }}</h1>
            {!! $type->introduction !!}
          </div>
            <ul class="page-breadcrumb">
              <li><a href="{{ route('pages.home') }}"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>{{ $type->title}}</span> </li>
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
                                <li class="color">$ {{ round($post->getMetaData('price') / $post->getMetaData('discount')) }} /</li>
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
                <div id="cart-success-message" class="alert alert-success alert-dismissible" style="display: none;" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     Product is added to cart
                   </div>
                   <div id="cart-danger-message" class="alert alert-danger alert-dismissible" style="display: none;" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      Product is already added to cart
                   </div>
                <div class="isotope-filters">
                    <button data-filter="" class="active">All</button>
                    <button data-filter=".latest">Latest</button>
                    <button data-filter=".sale">On Sale</button>
                  </div>
                  <div class="isotope columns-2 popup-gallery">
                  @forelse ($records as $post)
                  <div class="grid-item {{ $post->getMetaData('discount') !=  null? 'sale' : 'latest' }}">
                    <div class="listing-post">
                          <div class="blog-overlay">
                                <div class="blog-image">
                                      <img class="feature-image-product img-fluid" src="{{ asset('/storage/'. $post->getMetaData('featured_image')) }}" alt="{{ $post->title }}">
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
                      <div class="listing-post-info" style="background:#f7f7f7 !important;">
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
                    <h2 class="text-center">Records Not Found</h2>
                  </div>
                  @endforelse
               </div>
               <div class="w-100">
                   <div class="paginate">
                       {!! $records->links() !!}
                   </div>
               </div>
              </div>
            </div>
        </div>
</section>
@endsection
@push('scripts')
    <script src="{{asset('backend/js/cart-create.js') }}"></script>
@endpush
