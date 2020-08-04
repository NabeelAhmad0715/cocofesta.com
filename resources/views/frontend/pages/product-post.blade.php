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
                    <img class="img-fluid" src="{{ asset('images/11.jpg') }}" alt="">
                    <img class="img-fluid" src="images/shop/detail/big/02.jpg" alt="">
                    <img class="img-fluid" src="images/shop/detail/big/03.jpg" alt="">
                    <img class="img-fluid" src="images/shop/detail/big/04.jpg" alt="">
                    <img class="img-fluid" src="images/shop/detail/big/05.jpg" alt="">
                    <img class="img-fluid" src="images/shop/detail/big/06.jpg" alt="">
                </div>
                <div class="slider slider-nav">
                    <img class="img-fluid" src="{{ asset('images/11.jpg') }}" alt="">
                    <img class="img-fluid" src="images/shop/detail/thum/02.jpg" alt="">
                    <img class="img-fluid" src="images/shop/detail/thum/03.jpg" alt="">
                    <img class="img-fluid" src="images/shop/detail/thum/04.jpg" alt="">
                    <img class="img-fluid" src="images/shop/detail/thum/05.jpg" alt="">
                    <img class="img-fluid" src="images/shop/detail/thum/06.jpg" alt="">
                </div>
             </div>
           </div>
           <div class="col-lg-6">
             <div class="product-detail clearfix">
              <div class="product-detail-title mb-20 sm-mt-40">
                  <h4 class="mb-10"> Product name</h4>
                  <span>Consectetur lorem ipsum dolor sit amet, adipisicing elit. Accusamus officiis pariatur optio nobis culpa magni labor!  </span>
              </div>
              <div class="clearfix mb-30">
                <div class="product-detail-price"><del>$39.99</del> <ins>$24.99</ins></div>
                  <div class="product-detail-rating float-right">
                    <div class='rating-stars' style="margin: 16px 0px 16px 0px;">
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
                <div class="input-group">
                      <input type="number" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
                  </div>
                  <div class="product-detail add-to-cart">
                      @php
                      $price = $post->getMetaData('price');
                      $discount = $price / ($post->getMetaData('discount'));
                      @endphp
                      <a data-data="{{ $post->id }}" data-id="{{ $post->getMetaData('discount') ? $discount : $post->getMetaData('price') }}" class="button small addtocart" href='javascript:;'>Add to cart</a>
                  </div>
                    <a style="margin-top:10px;" data-data="{{ $post->id }}" class="button small addtowishlist" href='javascript:;' >Add to Whishlist</a>
                </div>
                <div class="product-detail-des mb-30">
                     <p class="mb-30">Adipisicing elit lorem ipsum dolor sit amet, consectetur. Dicta fugit cupiditate voluptates architecto nam totam ut, aperiam consequuntur aliquam voluptatem provident .</p>
                   <ul class="list list-unstyled list-arrow">
                     <li>Voluptatem provident</li>
                     <li>Aperiam consequuntur</li>
                     <li>Officia doloremque</li>
                  </ul>
             </div>
             <div class="product-detail-meta">
                 <span>SKU: 8465415 </span>
                 <span>Category: <a href="#">Shop</a>  </span>
                 <span>Tags: <a href="#">Shoes,</a> <a href="#">T-Shirt,</a> <a href="#">Shirt</a>  </span>
             </div>
             <div class="product-detail-social">
                <span>Share:</span>
                 <ul class="list-style-none">
                     <li><a href="#"> <i class="fa fa-facebook"></i> </a></li>
                     <li><a href="#"> <i class="fa fa-twitter"></i> </a></li>
                     <li><a href="#"> <i class="fa fa-google-plus"></i> </a></li>
                     <li><a href="#"> <i class="fa fa-rss"></i> </a></li>
                     <li><a href="#"> <i class="fa fa-envelope-o"></i> </a></li>
                 </ul>
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
              <a class="nav-link" id="additional-tab" data-toggle="tab" href="#additional" role="tab" aria-controls="additional" aria-selected="false">Profile </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews </a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="description" role="tabpanel" aria-labelledby="description-tab">
              <h6>Consectetur adipisicing elit</h6>
                 <p class="mt-20">Temporibus possimus quasi beatae, consectetur adipisicing elit. Obcaecati unde molestias sunt officiis aliquid sapiente, numquam, porro perspiciatis neque voluptatem sint hic quam eveniet ad adipisci laudantium corporis ipsam ea!</p>

                  <p class="mt-20">Consectetur adipisicing elit. Dicta, amet quia ad debitis fugiat voluptatem neque dolores tempora iste saepe cupiditate, molestiae iure voluptatibus est beatae? Culpa, illo a You will begin to realize why, consectetur adipisicing elit. Commodi, doloribus, earum modi consectetur molestias asperiores sequi ipsam neque error itaque veniam culpa eligendi similique ducimus nulla, blanditiis, perspiciatis atque saepe! veritatis.</p>


                  <p class="mt-20">Adipisicing consectetur elit. Dicta, amet quia ad debitis fugiat voluptatem neque dolores tempora iste saepe cupiditate, molestiae iure voluptatibus est beatae? Culpa, illo a You will begin to realize why, consectetur adipisicing elit. Commodi, doloribus, earum modi consectetur molestias asperiores.</p>


                  <p class="mt-20">Voluptatem adipisicing elit. Dicta, amet quia ad debitis fugiat neque dolores tempora iste saepe cupiditate, molestiae iure voluptatibus est beatae? Culpa, illo a You will begin to realize why, consectetur adipisicing elit. Commodi, You will begin to realize why, consectetur adipisicing elit. Laudantium nisi eaque maxime totam, iusto accusantium esse placeat rem at temporibus minus architecto ipsum eveniet. Delectus cum sunt, ea cumque quas! doloribus, earum modi consectetur molestias asperiores sequi ipsam neque error itaque veniam culpa eligendi similique ducimus nulla, blanditiis, perspiciatis atque saepe! veritatis. </p>
            </div>
            <div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
              <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th scope="row"> Air Conditioning</th>
                        <td>Mark</td>
                      </tr>
                      <tr>
                        <th scope="row"> Alloy Wheels</th>
                        <td>Jacob</td>
                      </tr>
                      <tr>
                        <th scope="row"> Anti-Lock Brakes (ABS)</th>
                        <td>Larry</td>
                      </tr>
                      <tr>
                        <th scope="row"> Anti-Theft</th>
                        <td>Larry</td>
                      </tr>
                      <tr>
                        <th scope="row">Anti-Starter</th>
                        <td>Larry</td>
                      </tr>
                      <tr>
                        <th scope="row">Alloy Wheels</th>
                        <td>Larry</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
              <div class="blog-comments mt-40">
                <div id="review-success-message" class="alert alert-success alert-dismissible" style="display: none;" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   Thank You For Your Feedback :)
                 </div>
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
                      @forelse ($post->reviews as $review)
                      <input type="hidden" value="{{ $review->rating }}" id="rating-star"/>
                          <div class="comments-1">
                              <div class="comments-info">
                                  <h6> {{ $review->user->name }} <span id="date">{{ date('d M Y', strtotime($review->created_at)) }}</span></h6>
                                  <div class='rating-stars' style="margin: 16px 0px 16px 0px;">
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
               <div class="sidebar-widget mb-40">
                   <h5 class="mb-20">Search</h5>
                     <div class="widget-search">
                     <i class="fa fa-search"></i>
                     <input type="search" class="form-control placeholder" placeholder="Search....">
                   </div>
                 </div>
                <div class="sidebar-widget mb-40">
                <h5 class="mb-20">Categories</h5>
                    <div class="widget-link">
                        <ul>
                            <li> <a href="shop-single.html"> <i class="fa fa-angle-double-right"></i> Product name </a></li>
                            <li> <a href="shop-single.html"> <i class="fa fa-angle-double-right"></i> Product name </a> </li>
                            <li> <a href="shop-single.html"> <i class="fa fa-angle-double-right"></i> Product name (10) </a> </li>
                            <li> <a href="shop-single.html"> <i class="fa fa-angle-double-right"></i> Product name </a> </li>
                            <li> <a href="shop-single.html"> <i class="fa fa-angle-double-right"></i> Product name (20) </a> </li>
                        </ul>
                    </div>
                 </div>
                <div class="sidebar-widget mb-0">
                <h5 class="mb-20">Popular items</h5>
                 <div class="recent-item clearfix">
                    <div class="recent-image">
                        <a href="shop-single.html"><img class="img-fluid" src="images/shop/08.jpg" alt=""></a>
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
      </div>
    </div>
 </section>

<section class="page-section-ptb">
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
       <div class="col-lg-3 col-sm-6 sm-mb-30">
        <div class="product">
            <div class="product-image">
                <img class="img-fluid mx-auto" src="images/shop/01.jpg" alt="">
                <div class="product-overlay">
                  <div class="add-to-cart">
                     <a href="shop-single.html">add to cart</a>
                  </div>
                </div>
             </div>
             <div class="product-des">
                <div class="product-title">
                  <a href="shop-single.html">Product name</a>
                </div>
                <div class="product-rating">
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star-half-o"></i>
                 <i class="fa fa-star-o"></i>
             </div>
             <div class="product-price">
                   <del>$24.99</del> <ins>$12.49</ins>
                </div>
           </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 sm-mb-30">
        <div class="product ">
            <div class="product-image">
                <img class="img-fluid mx-auto" src="images/shop/02.jpg" alt="">
                <div class="product-overlay">
                  <div class="add-to-cart">
                     <a href="shop-single.html">add to cart</a>
                  </div>
                </div>
             </div>
             <div class="product-des">
                <div class="product-title">
                  <a href="shop-single.html">Product name</a>
                </div>
                <div class="product-rating">
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star-half-o"></i>
                 <i class="fa fa-star-o"></i>
             </div>
             <div class="product-price">
                   <del>$24.99</del> <ins>$12.49</ins>
                </div>
           </div>
        </div>
       </div>
       <div class="col-lg-3 col-sm-6 xs-mb-30">
        <div class="product">
            <div class="product-image">
                <img class="img-fluid mx-auto" src="images/shop/03.jpg" alt="">
                <div class="product-overlay">
                  <div class="add-to-cart">
                     <a href="shop-single.html">add to cart</a>
                  </div>
                </div>
             </div>
             <div class="product-des">
                <div class="product-title">
                  <a href="shop-single.html">Product name</a>
                </div>
                <div class="product-rating">
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star-half-o"></i>
                 <i class="fa fa-star-o"></i>
             </div>
             <div class="product-price">
                   <del>$24.99</del> <ins>$12.49</ins>
                </div>
           </div>
        </div>
       </div>
       <div class="col-lg-3 col-sm-6">
        <div class="product">
            <div class="product-image">
                <img class="img-fluid mx-auto" src="images/shop/04.jpg" alt="">
                <div class="product-overlay">
                  <div class="add-to-cart">
                     <a href="shop-single.html">add to cart</a>
                  </div>
                </div>
             </div>
             <div class="product-des">
                <div class="product-title">
                  <a href="shop-single.html">Product name</a>
                </div>
                <div class="product-rating">
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star"></i>
                 <i class="fa fa-star-half-o"></i>
                 <i class="fa fa-star-o"></i>
             </div>
             <div class="product-price">
                   <del>$24.99</del> <ins>$12.49</ins>
                </div>
           </div>
        </div>
       </div>
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
