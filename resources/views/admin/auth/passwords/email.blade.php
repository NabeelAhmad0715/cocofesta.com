@extends('admin.layouts.portal')

@section('head')
    <title>Request password reset | Admin Panel</title>
@endsection

@section('content')
<div class="content d-flex justify-content-center align-items-center">
    <!-- Login form -->
    <form method="POST" action="{{ route('admin.password.email') }}">
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
                    <span class="d-block text-muted">Enter your Email below</span>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}<i class="icon-circle-right2 ml-2"></i></button>
                </div>
            </div>
        </div>
    </form>
    <!-- /login form -->
</div>
@endsection
