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
        <span class="breadcrumb-item active">Create</span>
    </div>
@endsection

@section('content')
    @include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Create Category</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                        <label>Title: <span
                            class="text-red">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                        @if ($errors->has('title')) <p style="color:red;">{{ $errors->first('title') }}</p> @endif
                    </div>
                    <div class="form-group">
                        <label>Subtitle:</label>
                        <input type="text" class="form-control" name="subtitle" value="{{ old('subtitle') }}" >
                        @if ($errors->has('subtitle')) <p style="color:red;">{{ $errors->first('subtitle') }}</p> @endif
                    </div>
                    <div class="form-group">
                        <label>Parent Category:</label>
                        <select class="form-control form-control-select2" name="parent_category">
                            <option value="">Select Parent Category...</option>
                            @forelse($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @empty
                                <option value="">No Parent Category Found</option>
                            @endforelse
                        </select>
                        @if ($errors->has('parent_category')) <p style="color:red;">{{ $errors->first('parent_category') }}</p> @endif
                    </div>
                    <div class="form-group">
                        <label>Types: <span
                            class="text-red">*</span></label>
                        <select class="form-control form-control-select2" name="type_id" required>
                            <option value="">Select Type...</option>
                            @forelse($types as $type)
                                <option value="{{$type->id}}">{{$type->title}}</option>
                            @empty
                                <option value="">No Type Found</option>
                            @endforelse
                        </select>
                        @if ($errors->has('type_id')) <p style="color:red;">{{ $errors->first('type_id') }}</p> @endif
                    </div>
                    <div class="form-group">
                        <label>Display Order:</label>
                        <input type="number" class="form-control" name="display_order" value="{{ (old('display_order') )? old('display_order') : '0'}}">
                        @if ($errors->has('display_order')) <p style="color:red;">{{ $errors->first('display_order') }}</p> @endif
                    </div>
                    <div class="form-group">
                        <label>Body:</label>
                        <textarea type="text" class="form-control" name="body" value="{{ old('body') }}" ></textarea>
                        @if ($errors->has('body')) <p style="color:red;">{{ $errors->first('body') }}</p> @endif
                    </div>
                    <!-- Header Images -->
                    <div class="form-group">
                        <label style="display: inline-block">Header Image: </label>
                        <div style="display: block">
                            <input type="text" style="display: none" name="header_image" id="header-image">
                            <button type="button" class="btn btn-primary  trigger-image-utility" data-target="header-image" data-type="single">Upload Header Image </button>
                        </div>
                        <span class="form-text text-muted span_message">Accepted formats: jpeg, png, jpg.</span>
                        @if ($errors->has('header_image')) <p style="color:red;">{{ $errors->first('header_image') }}</p> @endif
                    </div>
                    <!-- Featured Image -->
                    <div class="form-group">
                        <label style="display: inline-block">Featured Image: </label>
                        <div style="display: block">
                            <input type="text" style="display: none" name="featured_image" id="featured-image">
                            <button type="button" class="btn btn-primary  trigger-image-utility" data-target="featured-image" data-type="single">Upload Feature Image </button>
                        </div>
                        <span class="form-text text-muted span_message">Accepted formats: jpeg, png, jpg.</span>
                        @if ($errors->has('featured_image')) <p style="color:red;">{{ $errors->first('featured_image') }}</p> @endif
                    </div>

                    <fieldset class="mb-3" style="margin-top:5%;">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Fill the Meta Data Form</legend>
                        <div class="form-group">
                            <label>Meta Title:</label>
                            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}" >
                            @if ($errors->has('meta_title')) <p style="color:red;">{{ $errors->first('meta_title') }}</p> @endif
                        </div>

                        <div class="form-group">
                            <label>Meta Keyword:</label>
                            <input type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keywords') }}" >
                            @if ($errors->has('meta_keywords')) <p style="color:red;">{{ $errors->first('meta_keywords') }}</p> @endif
                        </div>

                        <div class="form-group">
                            <label>Meta description:</label>
                            <textarea type="text" class="form-control" name="meta_description"></textarea>
                            @if ($errors->has('meta_description')) <p style="color:red;">{{ $errors->first('meta_description') }}</p> @endif
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
