@extends('admin.layouts.layout')

@section('heading')
<h4><a href="{{ route('admin.pages.home') }}"><i class="icon-arrow-left52 mr-2"></i></a> <span
        class="font-weight-semibold">Home - Change Password</span></h4>
@endsection

@section('breadcrumbs')
<div class="breadcrumb">
    <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
    <span class="breadcrumb-item">Change Password</span>
</div>
@endsection

@section('content')
@include('admin.partials.header')
<div class="content">
    @include('common.partials.flash')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Change Password</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.change-password.update') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="font-weight-semibold @error('password') text-danger @enderror">Current Password <span
                            class="text-red">*</span></label>
                    <div class="form-group-feedback form-group-feedback-right">
                        <input type="password" name="password" value="{{ old('password') }}"
                            class="form-control @error('password') border-danger @enderror" required>
                        @error('password')
                        <div class="form-control-feedback text-danger">
                            <i class="icon-cancel-circle2"></i>
                        </div>
                        @enderror
                    </div>
                    @error('password')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold @error('new_password') text-danger @enderror">New Password <span
                            class="text-red">*</span></label>
                    <div class="form-group-feedback form-group-feedback-right">
                        <input type="password" name="new_password" value="{{ old('new_password') }}"
                            class="form-control @error('new_password') border-danger @enderror" required>
                        @error('new_password')
                        <div class="form-control-feedback text-danger">
                            <i class="icon-cancel-circle2"></i>
                        </div>
                        @enderror
                    </div>
                    @error('new_password')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-semibold @error('confirm_password') text-danger @enderror">Confirm Password <span
                            class="text-red">*</span></label>
                    <div class="form-group-feedback form-group-feedback-right">
                        <input type="password" name="confirm_password" value="{{ old('confirm_password') }}"
                            class="form-control @error('confirm_password') border-danger @enderror" required>
                        @error('confirm_password')
                        <div class="form-control-feedback text-danger">
                            <i class="icon-cancel-circle2"></i>
                        </div>
                        @enderror
                    </div>
                    @error('confirm_password')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
