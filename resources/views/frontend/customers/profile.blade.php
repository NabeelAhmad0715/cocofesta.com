@extends('frontend.layouts.layout')

@section('head')
    <title>Profile | As Fine Leather</title>
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
            <h1>Profile</h1>
            <p>We know the secret of your success</p>
          </div>
            <ul class="page-breadcrumb">
              <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>profile </span> </li>
         </ul>
       </div>
       </div>
    </div>
    <div class="overlay"></div>
</section>
<section class="gray-bg page-section-ptb">
    <div class="container">
        @include('common.partials.flash')
        <div class="row">
            <div class="col-md-12" style="display:flex;">
                <div class="col-md-4">
                    <div class="isotope-filters profile">
                        <button data-filter=".dashboard" class="active">
                         Dashboard
                        </button>
                        <button id="editProfileButton" data-filter=".edit-profile">
                          Edit Profile
                        </button>
                        <button id="orderHistoryButton" data-filter=".order-history">Order History</button>
                    </div>
                </div>
                <div id="dashboard" class="col-md-8">
                    <div class="container-fluid p-0">
                        <div class="isotope popup-gallery columns-4 no-padding">
                          <div class="grid-item dashboard w-100">
                            <div class="section-title">
                              <h2 class="title-effect">{{ auth()->user()->name }}</h2>
                              <p>
                                Truly ideal solutions for your business. Create a
                                website that you are gonna be proud of.
                              </p>
                            </div>
                            <p style="line-height: 2.5rem;">
                              We are providing creative marketing solutions mixed with
                              innovation and
                              <span
                                class="theme-color"
                                data-toggle="tooltip"
                                data-placement="top"
                                title=""
                                data-original-title="Experience Now! "
                              >
                                strategic approach</span
                              >. we are focused on delivering high-quality software
                              solutions which enable our customers to achieve their
                              critical IT objectives. Our management team is
                              multicultural, and many of them have worked with us for
                              a long time.
                            </p>
                            <div class="row">
                              <div class="col-sm-6 col-xs-6 col-xx-12">
                                <ul class="list list-unstyled list-hand">
                                  <li>Award-winning design</li>
                                  <li>Super Fast Customer support</li>
                                </ul>
                              </div>
                              <div class="col-sm-6 col-xs-6 col-xx-12">
                                <ul class="list list-unstyled list-hand">
                                  <li>Easy to Customize pages</li>
                                  <li>Powerful Performance</li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="container-fluid p-0" style="display:none;" id="editProfile">
                        <div class="isotope popup-gallery columns-4 no-padding">
                          <div class="grid-item edit-profile w-100">
                            <div class="section-title">
                              <h2 class="title-effect">Edit Profile</h2>
                            </div>
                            <div class="row">
                                <form class="w-100" action="{{ route('customers.edit-profile') }}" method="post">
                                @csrf
                                <div class="col-md-12 mb-5" style="display:flex;">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                        <input class="white-bg form-control" type="text" placeholder="Name" name="name" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input class="white-bg form-control" type="email" placeholder="Email" name="email" />
                                    </div>
                                </div>
                                <div class="col-md-12 mb-5" style="display:flex;">
                                  <div class="col-md-6">
                                      <label>Address</label>
                                      <input class="white-bg form-control" type="text" placeholder="Address" name="address" />
                                  </div>
                                  <div class="col-md-6">
                                      <label>Phone</label>
                                      <input class="white-bg form-control" type="tel" placeholder="Phone" name="phone" />
                                  </div>
                              </div>
                                <div class="col-md-12 mb-5" style="display:flex;">
                                    <div class="col-md-6">
                                        <label>Password</label>
                                        <input class="white-bg form-control" type="password" placeholder="Password" name="password" />
                                    </div>

                                    <div class="col-md-6">
                                        <label>New Password</label>
                                        <input class="white-bg form-control" type="password" Placeholder="New Password" name="new_password" />
                                    </div>
                                </div>
                                <div class="w-100 text-center">
                                    <input type="submit" class="button" value="Update" />
                                </div>
                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="container-fluid p-0" style="display:none;" id="orderHistory">
                        <div class="isotope popup-gallery columns-4 no-padding">
                          <div class="grid-item order-history w-100">
                            <div class="section-title">
                              <h2 class="title-effect">Order Histroy</h2>
                            </div>
                            <div class="row text-center mb-5">
                                <div class="col-md-4">
                                    <h2 class="title-effect">Image</h2>
                                </div>
                                <div class="col-md-4">
                                    <h2 class="title-effect">Description</h2>
                                </div>
                                <div class="col-md-4">
                                    <h2 class="title-effect">Total (${{ $orderHistories->sum('price') }})</h2>
                                </div>
                            </div>
                            @foreach ($orderHistories as $order)
                            <div class="row mb-5">
                                <div class="col-md-4">
                                    <img style="height:264px;" class="img-fluid" src="{{ asset('/storage/'. $order->post->getMetaData('featured_image'))}}"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="description-details text-center">
                                        <h3 class="theme-colo">{{ $order->post->title }}</h3>
                                        <p>{{ date('F d, Y', strtotime($order->created_at)) }}</p>
                                        <p><b>Order Number:</b> #{{ $order->order_number }}</p>
                                        <p><b>Qunatity:</b> {{ $order->quantity }}</p>
                                        <p><b>Size:</b> {{ $order->size }}</p>
                                        <p><b>Color:</b> {{ $order->color }}</p>
                                        @if($order->status == 0)
                                        <p><b>Status:</b> <span class="badge badge-primary" style="padding:7px;">Pending</span></p>
                                        @else
                                        <p><b>Status:</b> <span class="badge badge-success" style="padding:7px;">Approved</span></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4>${{ $order->price }}</h4>
                                </div>
                            </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    var editProfile = document.getElementById('editProfile');
    var editProfileButton = document.getElementById('editProfileButton');

    var orderHistory = document.getElementById('orderHistory');
    var orderHistoryButton = document.getElementById('orderHistoryButton');

    editProfile.style.display = 'none';
    editProfileButton.addEventListener('click', function (e) {
        editProfile.style.display = 'block';
    });

    orderHistory.style.display = 'none';
    orderHistoryButton.addEventListener('click', function (e) {
      orderHistory.style.display = 'block';
    });
  </script>
@endpush
