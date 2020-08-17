@extends('frontend.layouts.layout')

@section('head')
    <title>Homepage | Coco Cart</title>
    <meta name="description" content="Coco Cart">
    <meta name="keywords" content="Coco Cart">
@endsection

@section('content')
<section class="page-section-ptb bg-overlay-white-70 login-signup parallax" style="background: url({{ asset('images/login/07.jpg') }});">
    <div class="container">
     <div class="row no-gutter">
       <div class="col-md-5">
            <div class="login-box-02 bg-overlay-black-70 parallax" style="background: url({{ asset('images/login/01.jpg') }});">
                <div class="pb-50 pos-r clearfix">
                   <h4 class="mb-20 text-white"> Login here </h4>
                   <p class="mb-30 text-white">Welcome back, Please login to your account believing in yourself and those around you. </p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                 <div class="section-field mb-20">
                     <label class="mb-10 text-white" for="email">Email* </label>
                       <input id="email" class="form-control" type="email" placeholder="Email" name="email">
                       @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="section-field mb-20">
                     <label class="mb-10 text-white" for="Pas   sword">Password* </label>
                       <input id="Password" class="Password form-control" type="password" placeholder="Password" name="password">
                       @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="section-field">
                       <div class="custom-control custom-checkbox mb-30">
                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                        <label class="text-white custom-control-label" for="customControlAutosizing">Remember me</label>
                      </div>
                      </div>
                      <input type="submit" value="Log in" class="credentials-button button btn-block"/>
                </form>
                  </div>
                  <div class="login-social text-center clearfix pos-r">
                    <ul>
                        <li><a target="_blank" class="fb" href="{{ url('/login/facebook') }}"> Facebook</a></li>
                        <li><a target="_blank" class="pinterest" href="{{ route('login.google',['google']) }}"> google+</a></li>
                    </ul>
                  </div>
               </div>
           </div>
            <div class="col-md-7">
            <div class="login-box-02 theme-bg">
              <div class="pb-50 clearfix">
                <h4 class="mb-20 text-white">Or signup for free</h4>
                  <p class="mb-30 text-white">Sign-up for free trial now and build custom solutions. </p>
                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                      <div class="section-field mb-20" style="width:48%;margin-right: 2%;">
                       <label class="mb-10 text-white" for="name">Name*</label>
                         <input id="name" class="form-control" type="text" placeholder="Name" name="name">
                      </div>
                    <div class="section-field mb-20 w-50">
                         <label class="mb-10 text-white" for="name">Email* </label>
                          <input type="email" placeholder="Email*" class="form-control" name="email">
                     </div>
                    </div>
                    <div class="row">
                      <div class="section-field mb-20" style="width:48%;margin-right: 2%;">
                        <label class="mb-10 text-white" for="Password">Password* </label>
                          <input id="Password" class="Password form-control" type="password" placeholder="Password" name="password">
                       </div>
                    <div class="section-field mb-20 w-50">
                         <label class="mb-10 text-white" for="phone">Phone* </label>
                          <input type="tel" placeholder="Phone*" class="form-control" name="phone">
                     </div>
                    </div>
                    <div class="row">
                      <div class="section-field mb-20 w-100">
                        <label class="mb-10 text-white" for="address">Address*</label>
                          <input id="address" class="form-control" type="text" placeholder="Address" name="address">
                       </div>
                    </div>
                    <div class="row">
                      <input type="submit" value="Signup" class="w-100 button credentials-signup-button"/>
                    </div>
                  </form>
                </div>
                 <p class="text-white">by signing up, you agree to our <a class="text-black" href="#"> Terms and conditions </a> & <a class="text-black" href="#"> Privacy policy </a></p>
               </div>
            </div>
        </div>
    </div>
</section>
@endsection
