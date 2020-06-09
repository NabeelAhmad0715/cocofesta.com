@extends('frontend.layouts.layout')

@section('head')
    <title>Products | Coco Cart</title>
    <meta name="description" content="Coco Cart">
    <meta name="keywords" content="Coco Cart">
@endsection

@section('content')
<section class="page-title bg-overlay-black-60 parallax" data-jarallax='{"speed": 0.6}' style="background-image: url(images/bg/02.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="page-title-name">
            <h1>error 404 01</h1>
            <p>We know the secret of your success</p>
          </div>
            <ul class="page-breadcrumb">
              <li><a href="{{ route('pages.home') }}"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><a href="{{ route('pages.home') }}">page</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>error 404 01</span> </li>
         </ul>
       </div>
     </div>
    </div>
</section>

<section class="page-section-ptb">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-10 text-center">
               <div class="error-block text-center clearfix">
                <div class="error-text">
                  <h2>404</h2>
                  <span>Error </span>
                </div>
                <h1 class="theme-color mb-40">Ooopps :(</h1>
                <p>The Page you were looking for, couldn't be found.</p>
             </div>
              <div class="error-info">
                  <p class="mb-50">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
                  <a class="button xs-mb-10 " href="index-01.html">back to home</a>
                  <a class="button button-border black" href="#">back to Prev page</a>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection