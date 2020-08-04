@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('types.index') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - Types</span> - Create
    </h4>
@endsection

@section('breadcrumbs')
    <div class="breadcrumb">
        <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item"><a href="{{ route('types.index') }}"> Types </a></span>
        <span class="breadcrumb-item active">Add</span>
    </div>
@endsection

@section('content')
    @include('admin.partials.header')

    <div class="content">
        @include('common.partials.flash')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add Type</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('types.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Fill the form below to add a new post type</legend>
                    </fieldset>
                    <div class="form-group">
                        <label class=" @error('title') text-danger @enderror">Title <span
                                class="text-red">*</span></label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <input type="text" name="title"  value="{{ old('title') }}"
                                class="form-control @error('title') border-danger @enderror" required>
                            @error('title')
                            <div class="form-control-feedback text-danger">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('title')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class=" @error('subtitle') text-danger @enderror">Subtitle</label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <input type="text" name="subtitle"  value="{{ old('subtitle') }}"
                                class="form-control @error('subtitle') border-danger @enderror">
                            @error('subtitle')
                            <div class="form-control-feedback text-danger">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('subtitle')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label class=" @error('feature_image') text-danger @enderror">Featured Image
                            </label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <div style="display: block">
                                <input type="hidden" name="featured_image" id="featured-image">
                                <div id="featured-image-selected" style="margin-bottom: 10px;"></div>
                                <button type="button" class="btn btn-primary  trigger-image-utility" data-target="featured-image" data-type="single">Upload Feature Image </button>
                                <label id="featured-image-label"></label>
                            </div>
                            <span class="form-text text-muted">Accepted formats: jpeg, png, bmp, gif, svg, or webp</span>
                            @error('feature_image')
                            <div class="form-control-feedback text-danger">
                                <i class="feature_image-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('featured_image')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class=" @error('header_image') text-danger @enderror">Header
                            Image </label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <div style="display:block;">
                                <input type="hidden" name="header_image" id="header-image">
                                <div id="header-image-selected" style="margin-bottom: 10px;"></div>
                                <button type="button" class="btn btn-primary  trigger-image-utility" data-target="header-image" data-type="single">Upload Header Image </button>
                                <label id="header-image-label"></label>
                            </div>
                            <span class="form-text text-muted">Accepted formats: jpeg, png, bmp, gif, svg, or webp</span>
                            @error('header_image')
                            <div class="form-control-feedback text-danger">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('header_image')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class=" @error('introduction') text-danger @enderror">Introduction <span
                                class="text-red">*</span></label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <textarea name="introduction"  value="{{ old('introduction') }}"
                                class="form-control tinymce @error('introduction') border-danger @enderror" required>
                            </textarea>
                            @error('introduction')
                            <div class="form-control-feedback text-danger">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('introduction')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" id="meta-data-form">
                        @if(session('old-fields'))

                        @else
                        <div class="Parent-form">
                            <div id="fields" class="row meta-data meta-data-form-group">
                                <legend class="text-uppercase font-size-sm font-weight-bold">Field <span class="countFields"></span></legend>
                                <div class="col-md-4" style="margin-bottom:20px">
                                    <div class="form-group">
                                        <label class="">
                                            HTML field label
                                        </label>
                                        <input type="text" name="label_name[]" class="form-input-styled form-control">
                                    </div>
                                </div>

                                <div class="col-md-4" style="margin-bottom:20px">
                                    <div class="form-group">
                                        <label class="">Field type</label>
                                        <select name="field_type[]" id="field_type" class="form-input-styled form-control">
                                            <option value="">Select a field type</option>
                                            <option value="text">Text</option>
                                            <option value="textarea">Textarea</option>
                                            <option value="email">Email</option>
                                            <option value="boolean">Boolean</option>
                                            <option value="date">Date</option>
                                            <option value="hidden">Hidden</option>
                                            <option value="datetime-local">Datetime-local</option>
                                            <option value="color">Color</option>
                                            <option value="file">File</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-bottom:20px">
                                    <div class="form-group">
                                        <label class="">HTML field name</label>
                                        <input type="text" name="name[]" class="form-input-styled form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4" style="margin-bottom:20px">
                                    <div class="form-group">
                                        <label class="font-weight-semibold ">CSS classes</label>
                                        <input type="text" name="classes[]" class="form-input-styled form-control">
                                    </div>
                                </div>

                                <div class="col-md-4" style="margin-bottom:20px">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Is required?</label>
                                        <select name="required[]" class="form-input-styled form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="multipleImage" class="col-md-4" style="margin-bottom:20px">
                                    <div class="form-group">
                                        <label class="">Is multiple?</label>
                                        <select name="multiple[]" class="form-input-styled form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-bottom:12px">
                                    <div class="form-group">
                                        <label class="">Table visibility</label>
                                        <select name="field_visible[]" class="form-input-styled form-control">
                                            <option value="0">Off</option>
                                            <option value="1">On</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <hr>
                        <button type="button" style="margin-bottom:35px;" class="btn btn-primary" id="add-another-meta-data-btn" name="meta-data-fields"
                            data-toggle="modal" data-target="#exampleModal">
                            Add new field
                        </button>
                        @if ($errors->has('meta_data')) <p style="color:red;">{{ $errors->first('meta_data') }}</p>
                        @endif
                    </div>

                    <fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">For Meta Data</legend>
                        <div class="form-group">
                            <label class="font-weight-semibold @error('meta_title') text-danger @enderror">Meta
                                Title</label>
                            <div class="form-group-feedback form-group-feedback-right">
                                <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                                    class="form-control @error('meta_title') border-danger @enderror">
                                @error('meta_title')
                                <div class="form-control-feedback text-danger">
                                    <i class="icon-cancel-circle2"></i>
                                </div>
                                @enderror
                            </div>
                            @error('meta_title')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-semibold @error('meta_keywords') text-danger @enderror">
                                Meta Keywords
                            </label>
                            <div class="form-group-feedback form-group-feedback-right">
                                <input type="text" name="meta_keywords"
                                    value="{{ old('meta_keywords') }}"
                                    class="form-control @error('meta_keywords') border-danger @enderror">
                                @error('meta_keywords')
                                <div class="form-control-feedback text-danger">
                                    <i class="icon-cancel-circle2"></i>
                                </div>
                                @enderror
                            </div>
                            @error('meta_keywords')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-semibold @error('meta_description') text-danger @enderror">
                                Meta Description
                            </label>
                            <div class="form-group-feedback form-group-feedback-right">
                                <textarea name="meta_description"
                                    class="form-control @error('meta_description') border-danger @enderror"></textarea>
                                @error('meta_description')
                                <div class="form-control-feedback text-danger">
                                    <i class="icon-cancel-circle2"></i>
                                </div>
                                @enderror
                            </div>
                            @error('meta_description')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </fieldset>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
                @include('admin.partials.image-utility')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('backend/js/field-generator.js')}}"></script>
@endpush
