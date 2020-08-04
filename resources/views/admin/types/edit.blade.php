@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('types.index') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - Types</span> - {{$type->title}}
    </h4>
@endsection

@section('breadcrumbs')
    <div class="breadcrumb">
        <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item"><a href="{{ route('types.index') }}"> Types </a></span>
        <span class="breadcrumb-item active">Update</span>
    </div>
@endsection

@section('content')
    @include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')

        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Update Type</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('types.update',$type->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Fill the form below to update type
                        </legend>
                    </fieldset>

                    <div class="form-group">
                        <label class=" @error('title') text-danger @enderror">Title <span
                                class="text-red">*</span></label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <input type="text" name="title" value="{{$type->title}}"
                                value="{{ old('title') }}" class="form-control @error('title') border-danger @enderror"
                                required>
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
                            <input type="text" name="subtitle" value="{{$type->subtitle}}"
                                value="{{ old('subtitle') }}"
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
                        <label style="display: block;"
                            class=" @error('feature_image') text-danger @enderror">Featured Image </label>
                        <div class="d-inline-block" style="position: relative;margin-bottom: inherit;">

                        @forelse($featuredImage as $featuredImageRecord )
                                <div class="d-inline-block featured-images{{$featuredImageRecord->id}}"  style="position:relative;margin-bottom: inherit; ">
                                    <img src="{{ asset('/storage/'.$featuredImageRecord->name)}}" height="100px" width="atuo"/>
                                </div>
                        @empty
                            <p>No Image Found.</p>
                        @endforelse
                        <div style="display:block;">
                            <input type="hidden" name="featured_image" value="{{ $featuredImage }}" id="featured-image">
                            <div id="featured-image-selected" style="margin-bottom: 10px;"></div>
                            <button type="button" id="featured" class="btn btn-primary btn-md trigger-image-utility" data-type="single" data-id="{{$type->id}}" data-target="featured-image" data-content="{{$featuredImage}}" data-postid="{{$type->id}}"  data-class="App\Type">Update Featured Image </button>
                            <label id="featured-image-label"></label>
                        </div>
                        <span class="form-text text-muted">Accepted formats: jpeg, png, bmp, gif, svg, or webp</span>
                        @error('feature_image')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    </div>

                    <div class="form-group">
                        <label style="display: block;"
                            class=" @error('header_image') text-danger @enderror">Header Image</label>
                        @forelse($headerImages as $headerImage )
                            <div class="d-inline-block header-images{{$headerImage->id}}" style="position:relative;margin-bottom: inherit;">
                                <img src="{{ asset('/storage/'.$headerImage->name)}}" height="100px" width="auto"/>
                            </div>
                        @empty
                            <p>No Image Found.</p>
                        @endforelse
                        <div style="display:block;">
                            <input type="hidden" name="header_image" value="{{ $headerImages }}" class="header-images" id="header-image">
                            <div id="header-image-selected" style="margin-bottom: 10px;"></div>
                            <button type="button" id="header" class="btn btn-primary btn-md trigger-image-utility" data-content="{{$headerImages}}" data-target="header-image" data-postid="{{$type->id}}" data-type="single" data-class="App\Type">Update Header Image</button>
                            <label id="header-image-label"></label>
                        </div>
                        <span class="form-text text-muted">Accepted formats: jpeg, png, bmp, gif, svg, or webp</span>
                        @error('header_image')
                        <div class="form-control-feedback text-danger">
                            <i class="icon-cancel-circle2"></i>
                        </div>
                        @enderror

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
                            {{$type->introduction}}
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

                    <div id="fields" class="row meta-data meta-data-form-group" style="margin-bottom:20px;">
                        @forelse ($type->metaData as $field)

                        <legend class="text-uppercase font-size-sm font-weight-bold">Field <span class="countFields"></span> </legend>
                        <div class="col-md-4" style="margin-bottom:20px">
                            <div class="form-group">
                                <label class="">HTML field label
                                </label>
                                <input type="text" name="label_name[]" value="{{ $field->label_name }}"
                                    class="form-input-styled form-control">
                            </div>
                        </div>

                        <div class="col-md-4" style="margin-bottom:20px">
                            <div class="form-group">
                                <label class=" ">Field
                                    type</label>
                                <select name="field_type[]" class="form-input-styled form-control">
                                    <option value="">Select a field type</option>
                                    <option {{ $field->field_type == 'text' ? 'selected' : '' }} value="text">Text</option>
                                    <option {{ $field->field_type == 'textarea' ? 'selected' : '' }} value="textarea">Textarea</option>
                                    <option {{ $field->field_type == 'email' ? 'selected' : '' }} value="email">Email
                                    </option>
                                    <option {{ $field->field_type == 'boolean' ? 'selected' : '' }} value="boolean">Boolean
                                    </option>
                                    <option {{ $field->field_type == 'date' ? 'selected' : '' }} value="date">Date</option>
                                    <option {{ $field->field_type == 'hidden' ? 'selected' : '' }} value="hidden">Hidden
                                    </option>
                                    <option {{ $field->field_type == 'datetime-local' ? 'selected' : '' }}
                                        value="datetime-local">Datetime-local</option>
                                    <option {{ $field->field_type == 'color' ? 'selected' : '' }} value="color">Color
                                    </option>
                                    <option {{ $field->field_type == 'file' ? 'selected' : '' }} value="file">File</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4" style="margin-bottom:20px">
                            <div class="form-group">
                                <label class=" ">HTML field name</label>
                                <input type="text" name="name[]" value="{{ $field->name }}"
                                    class="form-input-styled form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4" style="margin-bottom:20px">
                            <div class="form-group">
                                <label class=" ">CSS classes</label>
                                <input type="text" name="classes[]" value="{{ $field->classes }}"
                                    class="form-input-styled form-control">
                            </div>
                        </div>

                        <div class="col-md-4" style="margin-bottom:20px">
                            <div class="form-group">
                                <label class="">Is required?</label>
                                <select name="required[]" class="form-input-styled form-control">
                                    <option value="0">No</option>
                                    <option {{ $field->required == '1' ? 'selected' : '' }} value="1">Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4" style="margin-bottom:20px">
                            <div class="form-group">
                                <label class=" ">Is multiple?</label>
                                <select name="multiple[]" class="form-input-styled form-control">
                                    <option value="0">No</option>
                                    <option {{ $field->multiple == '1' ? 'selected' : '' }} value="1">Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4" style="margin-bottom:12px">
                            <div class="form-group">
                                <label class=" ">Table visibility</label>
                                <select name="field_visible[]" class="form-input-styled form-control">
                                    <option {{ $field->is_visible == '0' ? 'selected' : '' }} value="0">Off</option>
                                    <option {{ $field->is_visible == '1' ? 'selected' : '' }} value="1">On</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" value="{{ $field->id }}" name="meta_data_id[]" />
                        @empty

                        @endforelse
                    </div>
                    <hr>
                    <div class="row meta-data meta-data-form-group" style="margin-bottom:55px;">
                        <button type="button" class="btn btn-primary" id="add-another-meta-data-btn" name="meta-data-fields"
                            data-toggle="modal" data-target="#exampleModal">
                            Add new field
                        </button>
                    </div>

                    <fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Meta Information </legend>
                        <div class="form-group">
                            <label class=" @error('meta_title') text-danger @enderror">Meta Title</label>
                            <div class="form-group-feedback form-group-feedback-right">
                                <input type="text" name="meta_title" value="{{$type->meta_title}}"
                                    value="{{ old('meta_title') }}"
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
                            <label class=" @error('meta_keywords') text-danger @enderror">Meta
                                Keywords</label>
                            <div class="form-group-feedback form-group-feedback-right">
                                <input type="text" name="meta_keywords" value="{{$type->meta_keywords}}"
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
                            <label class=" @error('meta_description') text-danger @enderror">Meta
                                Description</label>
                            <div class="form-group-feedback form-group-feedback-right">
                                <textarea name="meta_description" value="{{ old('meta_description') }}"
                                    class="form-control @error('meta_description') border-danger @enderror">{{$type->meta_description}}</textarea>
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
