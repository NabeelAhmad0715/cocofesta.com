@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('admin.pages.home') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - General Settings</span>
    </h4>
@endsection

@section('breadcrumbs')
    <div class="breadcrumb">
        <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item">General Settings</span>
    </div>
@endsection

@section('content')
    @include('admin.partials.header')
    <div class="content">
        @include('admin.partials.alerts')

        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">General Settings</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('general-settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-semibold @error('site_logo') text-danger @enderror">Site Logo
                            <span class="text-red">*</span></label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <input type="file" accept=".jpeg,.png,.bmp,.gif,.svg,.webp" required name="site_logo">
                            <span class="form-text text-muted">Accepted formats: jpeg, png, bmp, gif, svg, or webp</span>
                            @error('site_logo')
                            <div class="form-control-feedback text-danger">
                                <i class="feature_image-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('site_logo')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-semibold @error('favicon_icon') text-danger @enderror">Favicon Icon <span class="text-red">*</span></label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <input type="file" accept=".jpeg,.png,.bmp,.gif,.svg,.webp" required name="favicon_icon">
                            <span class="form-text text-muted">Accepted formats: jpeg, png, bmp, gif, svg, or webp</span>
                            @error('favicon_icon')
                            <div class="form-control-feedback text-danger">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('favicon_icon')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-semibold @error('site_name') text-danger @enderror">Site Name <span
                                class="text-red">*</span></label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <input type="text" name="site_name" value="{{ old('site_name') }}"
                                class="form-control @error('site_name') border-danger @enderror" required>
                            @error('site_name')
                            <div class="form-control-feedback text-danger">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('site_name')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-semibold @error('admin_email') text-danger @enderror">Admin Email <span
                                class="text-red">*</span></label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <input type="email" name="admin_email" value="{{ old('admin_email') }}"
                                class="form-control @error('admin_email') border-danger @enderror">
                            @error('admin_email')
                            <div class="form-control-feedback text-danger">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('admin_email')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-semibold @error('from_email') text-danger @enderror">From Email <span
                                class="text-red">*</span></label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <input type="text" name="from_email" value="{{ old('from_email') }}"
                                class="form-control @error('from_email') border-danger @enderror">
                            @error('from_email')
                            <div class="form-control-feedback text-danger">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('from_email')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-semibold @error('reply_email') text-danger @enderror">Reply Email <span
                                class="text-red">*</span></label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <input type="email" name="reply_email" value="{{ old('reply_email') }}"
                                class="form-control @error('reply_email') border-danger @enderror">
                            @error('reply_email')
                            <div class="form-control-feedback text-danger">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('reply_email')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-semibold @error('auto_respond_email') text-danger @enderror">Auto Respond Email <span
                                class="text-red">*</span></label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <input type="email" name="auto_respond_email" value="{{ old('auto_respond_email') }}"
                                class="form-control @error('auto_respond_email') border-danger @enderror">
                            @error('auto_respond_email')
                            <div class="form-control-feedback text-danger">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('auto_respond_email')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-semibold @error('support_email') text-danger @enderror">Support Email <span
                                class="text-red">*</span></label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <input type="email" name="support_email" value="{{ old('support_email') }}"
                                class="form-control @error('support_email') border-danger @enderror">
                            @error('support_email')
                            <div class="form-control-feedback text-danger">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('support_email')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
