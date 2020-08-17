@extends('frontend.layouts.layout')

@section('head')
    <title>About | As Fine Leather</title>
    <meta name="description" content="About | As Fine Leather">
    <meta name="keywords" content="About | As Fine Leather">
@endsection

@section('content')
{{ session(['link' => url()->current()]) }}
<section class="page-title bg-overlay-black-60 parallax" data-jarallax='{"speed": 0.6}' style="background-image: url({{ asset('images/bg/02.jpg') }});">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="page-title-name">
            <h1>About us</h1>
            <p>We know the secret of your success</p>
          </div>
            <ul class="page-breadcrumb">
              <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>About us</span> </li>
         </ul>
       </div>
       </div>
    </div>
</section>

<section class="page-section-ptb">
    <div class="container">
       <div class="row">
        <div class="col-lg-6">
            <img class="img-fluid full-width mb-20" src="{{ asset('images/about/02.jpg') }}" alt="">
          </div>
        <div class="col-lg-6 sm-mt-30">
          <div class="section-title">
              <h6>Who we are and what we do</h6>
              <h2 class="title-effect">Get to know us better.</h2>
              <p>We truly care about our users and our product. We are dedicated to providing you with the best experience possible. </p>
            </div>
            <p>Let's make something great together consectetur adipisicing elit. <span class="theme-color" data-toggle="tooltip" data-placement="top" title="" data-original-title="HTML5 template">Webster</span>  conseqt quibusdam, enim expedita sed quia nesciunt. Vero quod conseqt quibusdam, enim expedita sed quia nesciunt incidunt accusamus necessitatibus</p>
           <div class="row mt-30">
            <div class="col-md-6">
              <ul class="list list-unstyled list-hand">
                <li> Award-winning design</li>
                <li> Super Fast Customer support </li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="list list-unstyled list-hand">
                <li> Easy to Customize pages</li>
                <li> Powerful Performance </li>
              </ul>
            </div>
          </div>
        </div>
       </div>
         <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4">
           <div class="feature-text left-icon mt-50 xs-mt-20">
            <div class="feature-icon">
                <span class="ti-desktop theme-color" aria-hidden="true"></span>
                </div>
              <div class="feature-info">
                <h5 class="text-back">Our company</h5>
                <p>Enim expedita sed quia nesciunt, dolor sit consectetur conseqt quibusdam</p>
              </div>
           </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="feature-text left-icon mt-50 xs-mt-20">
          <div class="feature-icon">
                <span class="ti-server theme-color" aria-hidden="true"></span>
                </div>
              <div class="feature-info">
                <h5 class="text-back">Our Mission</h5>
                <p>Quia nesciunt dolor sit consectetur conseqt quibusdam, enim expedita sed </p>
              </div>
           </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="feature-text left-icon mt-50 xs-mt-20">
          <div class="feature-icon">
               <span class="ti-heart theme-color" aria-hidden="true"></span>
                </div>
              <div class="feature-info">
                <h5 class="text-back">We Love</h5>
                <p>Expedita sed quia nesciunt dolor sit consectetur conseqt quibusdam enim </p>
              </div>
           </div>
          </div>
       </div>
    </div>
</section>

<section class="our-activities page-section-ptb  bg-overlay-black-60 parallax" data-jarallax='{"speed": 0.6}' style="background-image: url(images/bg/06.jpg);">
    <div class="container">
       <div class="row justify-content-center">
        <div class="col-lg-10 text-center pt-30 pb-30">
          <h2 class="mb-20 text-white">Coco Cart has best women's & men's designs, and amazing support.</h2>
          <span class="theme-color"> - Nabeel Amjad</span>
        </div>
      </div>
   </div>
</section>

<section class="our-activities gray-bg page-section-ptb">
    <div class="container">
       <div class="row">
          <div class="col-lg-12">
            <div class="accordion plus-icon shadow">
                <div class="acd-group acd-active">
                    <a href="#" class="acd-heading acd-active">01. CAPABILITIES</a>
                    <div class="acd-des">Enim expedita sed quia nesciunt dolor sit amet, consectetur adipisicing elit. Vero quod conseqt quibusdam, incidunt accusamus necessitatibus modi adipisci officiaDolor sit amet, consectetur adipisicing elit. Vero quod conseqt quibusdam, enim expedita sed quia nesciunt incidunt accus</div>
                </div>
                <div class="acd-group">
                    <a href="#" class="acd-heading">02. Mission</a>
                    <div class="acd-des">Adipisicing elit lorem ipsum dolor sit amet quibusdam similique quam corporis sequi, consectetur. Tempora, ab officiis ducimus commodi, id, voluptates suscipit quasi nisi. Qui, explicabo quod laborum alias vero aliquid.</div>
                </div>
                <div class="acd-group">
                    <a href="#" class="acd-heading">03. Value</a>
                    <div class="acd-des">Tempora, ab officiis ducimus commodi quibusdam similique quam corporis sequi adipisicing elit lorem ipsum dolor sit amet, consectetur. id, voluptates suscipit quasi nisi. Qui, explicabo quod laborum alias vero aliquid.</div>
                </div>
            </div>
        </div>
      </div>
   </div>
</section>
@endsection