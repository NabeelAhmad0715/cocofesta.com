@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('posts.index',[$type->slug]) }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home -</span> {{$type->title}}
    </h4>
@endsection

@section('breadcrumbs')
    <div class="breadcrumb">
        <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item"><a href="{{ route('posts.index',['slug' => $type->slug]) }}">{{$type->title}} - Post </a></span>
        <span class="breadcrumb-item active">Update</span>
    </div>
@endsection

@section('content')
    @include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')

        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Update {{$type->title}}</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('posts.update',[$type->slug,$post->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Fill the form below to update type
                        </legend>
                    </fieldset>
                    <div class="form-group">
                        <label>Title: <span
                            class="text-red">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ $post->title }}">
                        @if ($errors->has('title')) <p style="color:red;">{{ $errors->first('title') }}</p> @endif
                    </div>
                    <div class="form-group">
                        <label class="@error('category_id') text-danger @enderror">Category</label>
                        <div class="form-group-feedback form-group-feedback-right">
                            <select name="category_id[]"
                                class="form-control multiselect-select-all-filtering @error('category_id') text-danger @enderror"
                                multiple="multiple">
                                @forelse ($categories as $key => $category)
                                <option @foreach ($post->categories as $category_id)
                                    @if($category->id == $category_id->id)
                                    selected="selected"
                                    @else
                                    ""
                                    @endif
                                    @endforeach

                                    value="{{ $category->id }}">
                                    {{ $category->title }}
                                </option>
                                @empty
                                <option value=""> Empty </option>
                                @endforelse

                            </select>
                            @error('status')
                            <div class="form-control-feedback text-danger">
                                <i class="icon-cancel-circle2"></i>
                            </div>
                            @enderror
                        </div>
                        @error('status')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @foreach($type->metaData as $key => $field)
                    <div class="form-group">
                        @if($field->field_type != 'file')
                        <label
                            class=" @error('{{ $field->label_name }}') text-danger @enderror">{{ $field->label_name }}
                            <span class="text-red"> {{ $field->required == '1' ? '*' : ''}}</span></label>
                        @else
                            <label
                            class=" @error('{{ $field->label_name }}') text-danger @enderror">{{ $field->label_name }}
                            <span class="text-red"> {{ $field->required == '1' ? '*' : ''}}</span></label>
                            <br>
                            @if ($field->multiple == 1 && $field->field_type == 'file')
                                @if($post->getMetaData($field->name))
                                    @foreach($post->getMetaData($field->name) as $image)
                                        <div class="d-inline-block" style="position: relative;margin-bottom: inherit;">
                                            @isset($image)
                                                <img src="{{ asset('/storage/' . $image)}}" height="100px" width="100px" />
                                                <a href="{{route('type.delete',[$field->id,$post->id,$image])}}" class="btn btn-danger text-white"
                                                onclick="return confirm('Are you sure you want to delete this image?')"
                                                style="position: absolute; top: 0; right: 0;"> &times; </a>
                                            @endisset
                                        </div>
                                        @endforeach
                                @endif
                            @elseif($field->multiple == 0 && $field->field_type == 'file')
                                <div class="d-inline-block" style="position: relative;margin-bottom: inherit;">
                                    @if($post->getMetaData($field->name))
                                        <img src="{{ asset('/storage/' . $post->getMetaData($field->name))}}" height="100px" width="100px" />
                                    @endif
                                </div>
                            @endif
                        @endif
                        <div class="form-group-feedback form-group-feedback-right">
                            @if ($field->field_type == 'textarea')
                                    <textarea name="{{ $field->name }}" class="{{ $field->classes }}" {{ $field->required == '1' ? '' : ''}}>@isset($post->metaData[$key]){{ $post->metaData[$key]->pivot->value }}@endisset</textarea>
                            @else
                                    <input type="{{ $field->field_type }}" value="@isset($post->metaData[$key]){{  $post->metaData[$key]->pivot->value }}@endisset"
                                        name=" {{ $field->name }}{{ $field->multiple == '1' ? '[]' : ''}}"
                                        class="{{ $field->classes }}"
                                        @if ($field->field_type == 'file')
                                            @if($post->getMetaData("images"))
                                            @if(count($post->getMetaData("images")) > 0)
                                                    {{ $field->required == '1' ? '' : ''}}
                                                @else
                                                    {{ $field->required == '1' ? 'required' : ''}}
                                                @endif
                                            @endif
                                        @else
                                            {{ $field->required == '1' ? 'required' : ''}}
                                        @endif
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
                    @endforeach
                    <div class="form-group">
                        <label>Tags:</label>
                        <input type="text" id="tag" name="tags" class="form-control tokenfield tag" value="{{$tags}}">
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
    <script src="{{ asset('backend/js/demo_pages/form_layouts.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset('backend/js/demo_pages/form_tags_input.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/forms/tags/tagsinput.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/forms/tags/tokenfield.min.js') }}"></script>
@endpush
