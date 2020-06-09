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
                    <div class="form-group">
                        <label>Title:*</label>
                        <input type="text" class="form-control" name="title"  value="{{ $category->title }}" required>
                        @if ($errors->has('title')) <p style="color:red;">{{ $errors->first('title') }}</p> @endif
                    </div>
                    <div class="form-group">
                        <label>Subtitle:</label>
                        <input type="text" class="form-control" name="subtitle" value="{{ $category->subtitle }}">
                        @if ($errors->has('subtitle')) <p style="color:red;">{{ $errors->first('subtitle') }}</p> @endif
                    </div>
                    <div class="form-group">
                        <label>Parent Category:</label>
                        <select class="form-control form-control-select2" name="parent_category">
                            <option value="">Select Parent Category...</option>
                            @forelse($allCategories as $allCategory )
                                <option {{ ( $category->parent_category==$allCategory->id)  ? 'selected' : ''  }} value="{{$allCategory->id}}">{{$allCategory->title}}</option>
                            @empty
                                <option value="">No Parent Category Found</option>
                            @endforelse
                            @if ($errors->has('category_id')) <p style="color:red;">{{ $errors->first('category_id') }}</p> @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type: <span
                            class="text-red">*</span></label>
                        <select class="form-control form-control-select2" name="type_id">
                            <option value="">Select Type...</option>
                            @forelse($types as $type )
                                <option {{ ( $category->type->id == $type->id)  ? 'selected' : '' }} value="{{$type->id}}">{{$type->title}}</option>
                            @empty
                                <option value="">No Type Found</option>
                            @endforelse
                            @if ($errors->has('type_id')) <p style="color:red;">{{ $errors->first('type_id') }}</p> @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Display Order:</label>
                        <input type="number" class="form-control" name="display_order" placeholder="Enter Display Order" value="{{$category->display_order}}">
                        @if ($errors->has('display_order')) <p style="color:red;">{{ $errors->first('display_order') }}</p> @endif
                    </div>

                    <!-- Header Images -->
                    <div class="form-group">
                        <label style="display:block;">Header Images: </label>
                        @forelse($headerImages as $headerImage )
                            <div class="d-inline-block header-images{{$headerImage->id}}" style="position:relative;margin-bottom: inherit; ">
                                <img src="{{ asset('/storage/'.$headerImage->name)}}" height="100px" width="100px"/>
                            </div>
                        @empty
                            <p>No Image Found.</p>
                        @endforelse
                        <div style="display:block;">
                            <input type="text" style="display:none;" name="header_image" value="{{ $headerImages }}" id="header-images">
                            <button type="button" id="header" class="btn btn-primary btn-md trigger-image-utility" data-type="single" data-id="{{$category->id}}" data-target="header-images" data-postid="{{$category->id}}"  data-class="App\Category">Update Header Image </button>
                        </div>
                        @if ($errors->has('header_image')) <p style="color:red;">{{ $errors->first('header_image') }}</p> @endif
                    </div>
                    <!-- Featured Image -->
                    <div class="form-group">
                        <label style="display:block;">Featured Image: </label>
                        @forelse($featuredImage as $featuredImageRecord )
                            <div class="d-inline-block feature-images{{$featuredImageRecord->id}}" style="position:relative;margin-bottom: inherit; ">
                                <img src="{{ asset('/storage/'.$featuredImageRecord->name)}}" height="100px" width="100px"/>
                            </div>
                        @empty
                            <p>No Image Found.</p>
                        @endforelse
                        {{-- data-content="{{$featuredImage}}" --}}
                        <div style="display:block;">
                            <input type="text" style="display:none;" name="featured_image" value="{{ $featuredImage }}" id="featured-images">
                            <button type="button" id="featured" class="btn btn-primary btn-md trigger-image-utility" data-type="single" data-target="featured-images" data-id="{{$category->id}}"  data-postid="{{$category->id}}"  data-class="App\Category">Update Featured Image </button>
                        </div>
                        <span class="form-text text-muted">Accepted formats: jpeg, png, jpg.</span>
                        @if ($errors->has('featured_image')) <p style="color:red;">{{ $errors->first('featured_image') }}</p> @endif
                    </div>

                    <fieldset class="mb-3" style="margin-top:5%;">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Fill the Meta Data Form</legend>
                    </fieldset>
                    <div class="form-group">
                        <label>Meta Title:</label>
                        <input type="text" class="form-control" name="meta_title" value="{{$category->meta_title}}" >
                        @if ($errors->has('meta_title')) <p style="color:red;">{{ $errors->first('meta_title') }}</p> @endif
                    </div>

                    <div class="form-group">
                        <label>Meta Keyword:</label>
                        <input type="text" class="form-control" name="meta_keywords" value="{{ $category->meta_keywords }}" >
                        @if ($errors->has('meta_keywords')) <p style="color:red;">{{ $errors->first('meta_keywords') }}</p> @endif
                    </div>

                    <div class="form-group">
                        <label>Meta description:</label>
                        <textarea type="text" class="form-control" name="meta_description" value="{{ $category->meta_description }}" >{{ $category->meta_description }}</textarea>
                        @if ($errors->has('meta_description')) <p style="color:red;">{{ $errors->first('meta_description') }}</p> @endif
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
