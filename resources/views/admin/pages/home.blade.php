@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <span class="font-weight-semibold">Home</span> - Dashboard
    </h4>
@endsection

@section('breadcrumbs')
    <div class="breadcrumb">
        <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item active">Dashboard</span>
    </div>
@endsection

@section('content')
    @include('admin.partials.header')
    <!-- Content area -->
    <div class="content">
        @include('common.partials.flash')
        <!-- Dashboard content -->
        <div class="row">
            <div class="col-xl-12">
                <!-- Stats boxes -->
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <div class="card bg-teal-400">
                            <a href="{{ route('types.index') }}" class="text-white">
                                <div class="text-center card-body">
                                    <div>
                                        <h1 class="font-weight-semibold mb-0"><i class="icon-3x mr-1 icon-stack2"></i>
                                        </h1>
                                    </div>
                                    <div class="pt-2">
                                        <h1 class="font-weight-semibold mb-0">Types</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <div class="card bg-teal-400">
                            <a href="{{ route('categories.index') }}" class="text-white">
                                <div class="text-center card-body">
                                    <div>
                                        <h1 class="font-weight-semibold mb-0"><i class="icon-3x mr-1 icon-copy"></i>
                                        </h1>
                                    </div>
                                    <div class="pt-2">
                                        <h1 class="font-weight-semibold mb-0">Categories</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    @foreach ($types as $type)
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <div class="card bg-teal-400">
                            <a href="{{ route('posts.index',['slug' => $type->slug]) }}" class="text-white">
                                <div class="text-center card-body">
                                    <div>
                                        <h1 class="font-weight-semibold mb-0"><i class="icon-3x mr-1 icon-pencil7"></i>
                                        </h1>
                                    </div>
                                    <div class="pt-2">
                                        <h1 class="font-weight-semibold mb-0">{{ $type->title }}</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <div class="card bg-teal-400">
                            <a href="{{ route('contact-enquiries.index') }}" class="text-white">
                                <div class="text-center card-body">
                                    <div>
                                        <h1 class="font-weight-semibold mb-0"><i class="icon-3x mr-1 icon-phone2"></i>
                                        </h1>
                                    </div>
                                    <div class="pt-2">
                                        <h1 class="font-weight-semibold mb-0">Contact Enquiries</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <div class="card bg-teal-400">
                            <a href="{{ route('general-settings.edit',[1]) }}" class="text-white">
                                <div class="text-center card-body">
                                    <div>
                                        <h1 class="font-weight-semibold mb-0"><i class="icon-3x mr-1 icon-gear"></i>
                                        </h1>
                                    </div>
                                    <div class="pt-2">
                                        <h1 class="font-weight-semibold mb-0">General Settings</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- /Stats boxes -->
                </div>
            </div>
            <!-- /dashboard content -->
        </div>
        <!-- /content area -->
    </div>
@endsection
