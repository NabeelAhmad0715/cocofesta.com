@extends('frontend.layouts.layout')

@section('head')
    <title>Homepage | Coco Cart</title>
    <meta name="description" content="Coco Cart">
    <meta name="keywords" content="Coco Cart">
@endsection

@section('content')
<section class="login-box-main height-100vh page-section-ptb" style="background: url({{ asset('images/login/06.jpg') }});">
    <div class="login-box-main-middle" style="padding:69px">
    <div class="container">
       <div class="row justify-content-center no-gutter">
        <div class="col-lg-2 col-md-4">
          <div class="login-box-left  white-bg">
            <img class="logo-small" src="images/logo-icon-dark.png" alt="">
               <ul class="nav">
                 <li><a href="{{ route('login') }}"> <i class="ti-user"></i> Login</a></li>
                 <li class="active"><a href="{{ route('register') }}"> <i class="ti-pencil-alt"></i> Signup</a></li>
              </ul>
             <div class="social-icons color-hover clearfix pos-bot pb-30 pl-30">
              <ul>
                <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li class="social-instagram"><a href="#"><i class="fa fa-instagram"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
         <div class="col-md-4 theme-bg">
           <div class="login-box pos-r text-white login-box-theme">
            <h2 class="text-white mb-20">Welcome to webster</h2>
            <p class="mb-10 text-white">Create tailor-cut websites </p>
            <p class="text-white">The exclusive multi-purpose responsive template.</p>
            <ul class="list-unstyled pos-bot pb-40">
              <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a> </li>
              <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a></li>
            </ul>
           </div>
         </div>
         <div class="col-md-4">
          <div class="login-box pb-50 clearfix white-bg">
          <h3 class="mb-30">Signup</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="section-field mb-20">
                    <label class="mb-10" for="name">Name* </label>
                    <input id="name" class="web form-control" type="text" placeholder="Name" name="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="section-field mb-20">
                    <label class="mb-10" for="name">Email* </label>
                    <input id="email" class="web form-control" type="text" placeholder="Email" name="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="section-field mb-20">
                <label class="mb-10" for="Password">Password* </label>
                    <input id="Password" class="Password form-control" type="password" placeholder="Password" name="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="section-field">
                    <div class="custom-control custom-checkbox mb-30">
                        <input class="custom-control-input" type="checkbox" name="remember" id="remember">
                        <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                    </div>
                    </div>
                    <input type="submit" value="Signup" class="button"/>
                    {{-- <a href="#" class="button">
                    <span>Signup</span>
                    <i class="fa fa-check"></i>
                    </a> --}}
                </form>
            </div>
           </div>
          </div>
        </div>
    </div>
</section>
@endsection
