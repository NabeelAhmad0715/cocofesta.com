@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('admin.pages.home') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - {{$type->title}} Posts</span> - View All
    </h4>
@endsection

@section('breadcrumbs')
    <div class="breadcrumb">
        <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item"><a href="{{ route('posts.index',['slug' => $type->slug]) }}">{{$type->title}} </a></span>
        <span class="breadcrumb-item active">View All</span>
    </div>
@endsection

@section('content')
    @include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')
        <div class="card has-table">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ $type->title }}</h5>
                <div class="header-elements">
                    <a href="{{ route('posts.create',['slug' => $type->slug]) }}" class="mt-2 btn btn-primary">
                        Add New Post
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table datatable-pagination">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            @foreach($columns as $column)
                                <th>{{ $column->label_name }}</th>
                            @endforeach
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Last Modified</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $key => $post)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $post->title }}</td>
                            @foreach($columns as $column)
                                @if ($column->field_type == 'file')
                                <td> <img style="height:100px;width:100px" src="{{ asset('/storage/'. $post->getMetaData($column->name) ) }}" /></td>
                                @else
                                    <td>{{ $post->getMetaData($column->name) }}</td>
                                @endif
                            @endforeach
                            <td>
                                @isset($post->categories)
                                    @foreach($post->categories as $category)
                                        {{ $category->title }}

                                    @endforeach
                                @endisset
                            </td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->updated_at }}</td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ route('posts.edit', [$type->slug, $post->id]) }}"
                                                class="dropdown-item"><i class="icon-pencil5"></i> Edit</a>
                                            <a href="#" class="dropdown-item"
                                                onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this post?')){document.getElementById('delete-post-{{ $post->id }}-form').submit();}">
                                                <i class="icon-trash"></i>
                                                Delete
                                            </a>
                                            <form action="{{ route('posts.destroy', [$type->slug, $post->id]) }}"
                                                id="delete-post-{{ $post->id }}-form" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan=" 6 {{ $type->metaData()->where("is_visible", 1)->count() + 4 }}">
                                <div class="alert alert-info text-center">
                                    No Posts Added So Far
                                    <br>
                                    <a href="{{ route('posts.create',['slug' => $type->slug]) }}" class="mt-2 btn btn-primary">
                                        Add New Post
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('backend/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('backend/js/demo_pages/datatables_basic.js')}}"></script>
@endpush
