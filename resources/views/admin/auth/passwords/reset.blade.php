@extends('admin.layouts.portal')

@section('head')
    <title>Change password | Admin Panel</title>
@endsection

@section('content')
    <!-- Content area -->
    <div class="content d-flex justify-content-center align-items-center">
        <!-- Login form -->
        <form method="POST" action="{{ route('admin.password.update') }}">
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
                        <h5 class="mb-0">Reset to your account</h5>
                        <span class="d-block text-muted">Reset your credentials below</span>
                    </div>

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirm" required autocomplete="new-password">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Reset Password') }}<i class="icon-circle-right2 ml-2"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /login form -->
    </div>
    <!-- /content area -->
@endsection
