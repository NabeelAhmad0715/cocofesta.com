@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('posts.index',[$type->slug]) }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - {{$type->title}}</span> - Create
    </h4>
@endsection

@section('breadcrumbs')
    <div class="breadcrumb">
        <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item"><a href="{{ route('posts.index',['slug' => $type->slug]) }}">{{$type->title}} </a></span>
        <span class="breadcrumb-item active">Add</span>
    </div>
@endsection

@section('content')
    @include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')

        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add {{$type->title}}</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('posts.store',['slug' => $type->slug]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Fill the form below to create a new
                            Post</legend>
                    </fieldset>
                    <div class="form-group">
                        <label>Title: <span
                            class="text-red">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                        @if ($errors->has('title')) <p style="color:red;">{{ $errors->first('title') }}</p> @endif
                    </div>
                    <div class="form-group">
                        <label class="@error('category_id') text-danger @enderror">Category</label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <select name="category_id[]"
                                    class="form-control multiselect-select-all-filtering @error('category_id') text-danger @enderror"
                                     multiple="multiple">
                                @forelse($categories as $category)
                                    <option value="{{ $category->id}}">{{  $category->title  }}</option>
                                @empty
                                    <option value="">Empty</option>
                                @endforelse
                            </select>
                            @error('category_id')
                            <div class="form-control-feedback text-danger">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('category_id')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @forelse ($type->metaData as $field)
                    <div class="form-group">
                        <label
                            class=" @error('{{ $field->label_name }}') text-danger @enderror">
                            {{ $field->label_name }}
                            <span class="text-red"> {{ $field->required == '1' ? '*' : ''}}</span></label>
                            <div class="form-group-feedback form-group-feedback-right">
                                @if ($field->field_type == 'textarea')
                                    <textarea name="{{ $field->name }}" class="{{ $field->classes }}" {{ $field->required == '1' ? '' : ''}}></textarea>
                                @else
                                    <input type="{{ $field->field_type }}"
                                        name="{{ $field->name }}{{ $field->multiple == '1' ? '[]' : ''}}"
                                        class="{{ $field->classes }}"
                                        {{ $field->required == '1' ? 'required' : ''}}
                                        {{ $field->multiple == '1' ? 'multiple' : ''}}>

                                @endif
                                @error('{{ $field->label_name }}')
                                    <div class="form-control-feedback text-danger">
                                        <i class="icon-cancel-circle2"></i>
                                    </div>
                                @enderror
                            </div>
                        @error('{{ $field->label_name }}')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" value="{{ $field->id }}" name="meta_data_id[]">
                    @empty
                        <h3> Create Fields in Type module </h3>
                    @endforelse
                    <div class="form-group">
                        <label>Tags:</label>
                        <input type="text" name="tags" class="form-control tokenfield" value="">
                    </div>
                    <input type="hidden" value="{{ $type->id }}" name="type_id">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{  asset('backend/js/demo_pages/form_layouts.js') }}"></script>
    <script src="{{  asset('backend/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{  asset('backend/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{  asset('backend/js/demo_pages/form_tags_input.js') }}"></script>
    <script src="{{  asset('backend/js/plugins/forms/tags/tagsinput.min.js') }}"></script>
    <script src="{{  asset('backend/js/plugins/forms/tags/tokenfield.min.js') }}"></script>
@endpush
