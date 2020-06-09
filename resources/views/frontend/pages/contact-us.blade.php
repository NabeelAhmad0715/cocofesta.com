@extends('frontend.layouts.layout')

@section('head')
    <title>Contact us | Coco Cart</title>
    <meta name="description" content="Coco Cart">
    <meta name="keywords" content="Coco Cart">
@endsection

@section('content')

<section class="page-title bg-overlay-black-60 parallax" data-jarallax='{"speed": 0.6}' style="background-image: url({{ asset('images/bg/02.jpg') }});">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="page-title-name">
            <h1>About us 02</h1>
            <p>We know the secret of your success</p>
          </div>
            <ul class="page-breadcrumb">
              <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><a href="#">page</a> <i class="fa fa-angle-double-right"></i></li>
              <li><span>About us 02</span> </li>
         </ul>
       </div>
       </div>
    </div>
</section>


<section class="white-bg contact-3 o-hidden clearfix">
    <!-- =============================== -->
    <div class="container-fluid">
      <div class="row">
             <div class="col-lg-4 col-md-4 col-sm-4 contact-add gray-bg h-100">
              <div class="text-center">
                <i class="ti-map-alt"></i>
                <h4 class="mt-15">Address</h4>
                <p>17504 Carlton Cuevas Rd, Gulfport, MS, 3950</p>
               </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 contact-add theme-bg h-100">
               <div class="text-center">
                <i class="ti-mobile text-white"></i>
                <h4 class="text-white mt-15">Call Us</h4>
                <p class="text-white">+(704) 279-1249</p>
               </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 contact-add  black-bg h-100">
              <div class="text-center">
                <i class="ti-email text-white"></i>
                <h4 class="text-white mt-15">Email Us</h4>
                <p class="text-white">letstalk@webster.com</p>
              </div>
            </div>
           </div>
     </div>
</section>
<section class="page-section-ptb clearfix o-hidden" style="padding:50px 0px">
    <div class="container">
      <div class="row justify-content-end">
        <div class="contact-4 col-lg-6 sm-mb-30">
          <blockquote class="blockquote quote pl-0">
            The trouble with programmers is that you can never  too late. The future belongs of person with.
          </blockquote>
          <p>It would be great to hear from you! If you got any questions, please do not hesitate to send us a message. We are looking forward to hearing  please do not hesitate to send us a message. It would be great to hear from you! If you got any questions, please do not hesitate to send us a message.</p>
          <p> We are looking forward to hearing  please do not hesitate to send us a message. We are looking forward to hearing from you!</p>
        </div>
        <div class="contact-3 col-lg-6">
            <div class="contact-3-info page-section-ptb" style="padding: 47px 0px;">
            @include('common.partials.flash')
            <div class="clearfix">
                <form  method="post" action="{{ route('pages.contact-enquiry') }}">
                    @csrf
                    <div class="contact-form clearfix">
                    <div class="section-field">
                        <input id="name" type="text" placeholder="Name*" class="form-control"  name="name" required>
                        </div>
                        <div class="section-field">
                        <input type="email" placeholder="Email*" class="form-control" name="email" required>
                        </div>
                        <div class="section-field">
                        <input type="tel" placeholder="Phone*" class="form-control" name="phone" required>
                        </div>
                        <div class="section-field textarea">
                        <textarea class="input-message form-control" placeholder="Comment"  rows="7" name="comment"></textarea>
                        </div>
                        <div class="g-recaptcha section-field clearfix" data-sitekey="{{ config('app.recaptcha.CAPTCHA_KEY') }}"></div>
                        <div class="section-field submit-button">
                        <button id="submit" name="submit" type="submit" value="Send" class="button"><span> Send message </span> <i class="fa fa-paper-plane"></i></button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>
