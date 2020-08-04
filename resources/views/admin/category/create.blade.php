@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('categories.index') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - Categories</span> - Create
    </h4>
@endsection

@section('breadcrumbs')
    <div class="breadcrumb">
        <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item"><a href="{{ route('categories.index') }}"> Categories </a></span>
        <span class="breadcrumb-item active">Add</span>
    </div>
@endsection

@section('content')
    @include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add Category</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data" >
                    @csrf
                    <fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Fill the form below to add a new category</legend>
                    </fieldset>
                    <div class="form-group">
                        <label class="@error('title') text-danger @enderror">Title: <span
                            class="text-red">*</span></label>
                        <input type="text" class="form-control @error('title') border-danger @enderror" name="title" value="{{ old('title') }}" required>
                        @error('title')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="@error('subtitle') text-danger @enderror">Subtitle:</label>
                        <input type="text" class="form-control @error('subtitle') border-danger @enderror" name="subtitle" value="{{ old('subtitle') }}" >
                        @error('subtitle')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="@error('parent_category') text-danger @enderror">Parent Category:</label>
                        <select class="form-control @error('parent_category') border-danger @enderror form-control-select2" name="parent_category">
                            <option value="">Select Parent Category...</option>
                            @forelse($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @empty
                                <option value="">No Parent Category Found</option>
                            @endforelse
                        </select>
                        @error('parent_category')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="@error('type_id') text-danger @enderror">Types: <span
                            class="text-red">*</span></label>
                        <select class="form-control @error('type_id') border-danger @enderror form-control-select2" name="type_id" required>
                            <option value="">Select Type...</option>
                            @forelse($types as $type)
                                <option value="{{$type->id}}">{{$type->title}}</option>
                            @empty
                                <option value="">No Type Found</option>
                            @endforelse
                        </select>
                        @error('type_id')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="@error('display_order') text-danger @enderror">Display Order:</label>
                        <input type="number" class="form-control @error('display_order') border-danger @enderror" name="display_order" value="{{ (old('display_order') )? old('display_order') : '0'}}">
                        @error('display_order')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="@error('body') text-danger @enderror">Body:</label>
                        <textarea type="text" class="form-control @error('body') border-danger @enderror" name="body" value="{{ old('body') }}" ></textarea>
                        @error('body')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Header Images -->
                    <div class="form-group">
                        <label class="@error('header_image') text-danger @enderror" style="display: inline-block">Header Image: </label>
                        <div style="display: block">
                            <input type="hidden" name="header_image" id="header-image">
                            <div id="header-image-selected" style="margin-bottom: 10px;"></div>
                            <button type="button" class="btn btn-primary  trigger-image-utility" data-target="header-image" data-type="single">Upload Header Image </button>
                            <label id="header-image-label"></label>
                        </div>
                        <span class="form-text text-muted">Accepted formats: jpeg, png, bmp, gif, svg, or webp</span>
                        @error('header_image')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Featured Image -->
                    <div class="form-group">
                        <label class="@error('featured_image') text-danger @enderror" style="display: inline-block">Featured Image: </label>
                        <div style="display: block">
                            <input type="hidden" name="featured_image" id="featured-image">
                            <div id="featured-image-selected" style="margin-bottom: 10px;"></div>
                            <button type="button" class="btn btn-primary  trigger-image-utility" data-target="featured-image" data-type="single">Upload Feature Image </button>
                            <label id="featured-image-label"></label>
                        </div>
                        <span class="form-text text-muted">Accepted formats: jpeg, png, bmp, gif, svg, or webp</span>
                        @error('featured_image')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <fieldset class="mb-3" style="margin-top:5%;">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Meta Information </legend>
                        <div class="form-group">
                            <label class="@error('meta_title') text-danger @enderror">Meta Title:</label>
                            <input type="text" class="form-control @error('meta_title') border-danger @enderror" name="meta_title" value="{{ old('meta_title') }}" >
                            @error('meta_title')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="@error('meta_keywords') text-danger @enderror">Meta Keyword:</label>
                            <input type="text" class="form-control @error('meta_keywords') border-danger @enderror" name="meta_keywords" value="{{ old('meta_keywords') }}" >
                            @error('meta_keywords')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="@error('meta_description') text-danger @enderror">Meta Description</label>
                            <textarea type="text" class="form-control @error('meta_description') border-danger @enderror" name="meta_description"></textarea>
                            @error('meta_description')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </fieldset>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
                @include('admin.partials.image-utility')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{  asset('backend/js/demo_pages/form_layouts.js') }}"></script>
    <script src="{{  asset('backend/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{  asset('backend/js/plugins/forms/styling/uniform.min.js') }}"></script>
@endpush
