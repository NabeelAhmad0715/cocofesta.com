@extends('admin.layouts.portal')

@section('content')
    <!-- Content area -->
    <div class="content d-flex justify-content-center align-items-center">
        <!-- Login form -->
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="card mb-0">
                <div class="card-body" style="padding: 4rem 6rem; width:30rem;">
                    @include('common.partials.flash')
                    <div class="text-center mb-3">
                        @isset($settings)
                            <img style="width:50%;" src="{{ asset('/storage/'. $settings->site_logo ) }}">
                        @else
                            <img style="width:50%;" src="{{ asset('/backend/images/default-logo-dark.svg') }}">
                        @endisset
                        <h5 class="mb-0 mt-3">Login to your account</h5>
                        <span class="d-block text-muted">Enter your credentials below</span>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="current-password" required>
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div style="display:none;" class="form-group form-group-feedback form-group-feedback-left">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="remember" class="form-input-styled" data-fouc {{ old('remember') ? 'checked' : '' }}>
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Log in <i class="icon-circle-right2 ml-2"></i></button>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('admin.password.request') }}">Forgot password?</a>
                    </div>
                </div>
            </div>
        </form>
        <!-- /login form -->
    </div>
    <!-- /content area -->
@endsection
