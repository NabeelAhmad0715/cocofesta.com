@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('categories.index') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - Categories</span> - Update
    </h4>
@endsection

@section('breadcrumbs')
    <div class="breadcrumb">
        <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item"><a href="{{ route('categories.index') }}"> Categories </a></span>
        <span class="breadcrumb-item active">Update</span>
    </div>
@endsection

@section('content')
    @include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Update Category</h5>
            </div>
            <div class="card-body">
                <form  method="POST" action="{{route('categories.update',$category->id)}}" enctype="multipart/form-data" >
                    @csrf
                    @method('PUT')
                    <fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Fill the form below to update category</legend>
                    </fieldset>
                    <div class="form-group">
                        <label class="@error('title') text-danger @enderror">Title:*</label>
                        <input type="text" class="form-control @error('title') border-danger @enderror" name="title"  value="{{ $category->title }}" required>
                        @error('title')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="@error('subtitle') text-danger @enderror">Subtitle:</label>
                        <input type="text" class="form-control @error('subtitle') border-danger @enderror" name="subtitle" value="{{ $category->subtitle }}">
                        @error('subtitle')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="@error('parent_category') text-danger @enderror">Parent Category:</label>
                        <select class="form-control @error('parent_category') border-danger @enderror form-control-select2" name="parent_category">
                            <option value="">Select Parent Category...</option>
                            @forelse($allCategories as $allCategory )
                                <option {{ ( $category->parent_category==$allCategory->id)  ? 'selected' : ''  }} value="{{$allCategory->id}}">{{$allCategory->title}}</option>
                            @empty
                                <option value="">No Parent Category Found</option>
                            @endforelse
                            @error('parent_category')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="@error('type_id') text-danger @enderror">Type: <span
                            class="text-red">*</span></label>
                        <select class="form-control @error('type_id') border-danger @enderror  form-control-select2" name="type_id">
                            <option value="">Select Type...</option>
                            @forelse($types as $type )
                                <option {{ ( $category->type->id == $type->id)  ? 'selected' : '' }} value="{{$type->id}}">{{$type->title}}</option>
                            @empty
                                <option value="">No Type Found</option>
                            @endforelse
                            @error('type_id')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="@error('display_order') text-danger @enderror">Display Order:</label>
                        <input type="number" class="form-control @error('display_order') border-danger @enderror" name="display_order" placeholder="Enter Display Order" value="{{$category->display_order}}">
                        @error('display_order')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Header Images -->
                    <div class="form-group">
                        <label class="@error('header_image') text-danger @enderror" style="display:block;">Header Images: </label>
                        @forelse($headerImages as $headerImage )
                            <div class="d-inline-block header-images{{$headerImage->id}}" style="position:relative;margin-bottom: inherit; ">
                                <img src="{{ asset('/storage/'.$headerImage->name)}}" height="100px" width="auto"/>
                            </div>
                        @empty
                            <p>No Image Found.</p>
                        @endforelse
                        <div style="display:block;">
                            <input type="hidden" name="header_image" value="{{ $headerImages }}" id="header-image">
                            <div id="header-image-selected" style="margin-bottom: 10px;"></div>
                            <button type="button" id="header" class="btn btn-primary btn-md trigger-image-utility" data-type="single" data-id="{{$category->id}}" data-target="header-image" data-postid="{{$category->id}}"  data-class="App\Category">Update Header Image </button>
                            <label id="header-image-label"></label>
                        </div>
                        <span class="form-text text-muted">Accepted formats: jpeg, png, bmp, gif, svg, or webp</span>
                        @error('header_image')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Featured Image -->
                    <div class="form-group">
                        <label class="@error('featured_image') text-danger @enderror" style="display:block;">Featured Image: </label>
                        @forelse($featuredImage as $featuredImageRecord )
                            <div class="d-inline-block feature-images{{$featuredImageRecord->id}}" style="position:relative;margin-bottom: inherit; ">
                                <img src="{{ asset('/storage/'.$featuredImageRecord->name)}}" height="100px" width="auto"/>
                            </div>
                        @empty
                            <p>No Image Found.</p>
                        @endforelse
                        {{-- data-content="{{$featuredImage}}" --}}
                        <div style="display:block;">
                            <input type="hidden" name="featured_image" value="{{ $featuredImage }}" id="featured-image">
                            <div id="featured-image-selected" style="margin-bottom: 10px;"></div>
                            <button type="button" id="featured" class="btn btn-primary btn-md trigger-image-utility" data-type="single" data-target="featured-image" data-id="{{$category->id}}"  data-postid="{{$category->id}}"  data-class="App\Category">Update Featured Image </button>
                            <label id="featured-image-label"></label>
                        </div>
                        <span class="form-text text-muted">Accepted formats: jpeg, png, bmp, gif, svg, or webp</span>
                        @error('featured_image')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <fieldset class="mb-3" style="margin-top:5%;">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Meta Information </legend>
                    </fieldset>
                    <div class="form-group">
                        <label class="@error('meta_title') text-danger @enderror">Meta Title:</label>
                        <input type="text" class="form-control @error('meta_title') border-danger @enderror" name="meta_title" value="{{$category->meta_title}}" >
                        @error('meta_title')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="@error('meta_keywords') text-danger @enderror">Meta Keyword:</label>
                        <input type="text" class="form-control @error('meta_keywords') border-danger @enderror" name="meta_keywords" value="{{ $category->meta_keywords }}" >
                        @error('meta_keywords')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="@error('meta_description') text-danger @enderror">Meta Description</label>
                        <textarea type="text" class="form-control @error('meta_description') border-danger @enderror" name="meta_description" value="{{ $category->meta_description }}" >{{ $category->meta_description }}</textarea>
                        @error('meta_description')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
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
