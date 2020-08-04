@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('admin.pages.home') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - Categories</span> - View All
    </h4>
@endsection

@section('breadcrumbs')
<div class="breadcrumb">
    <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
    <span class="breadcrumb-item"><a href="{{ route('categories.index') }}"> Categories </a></span>
    <span class="breadcrumb-item active">View All</span>
</div>
@endsection

@section('content')
@include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')
        <div class="card has-table">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Categories</h5>
                <div class="header-elements">
                    <a href="{{ route('categories.create') }}" class="mt-2 btn btn-primary">
                        Add New Category
                    </a>
                </div>
            </div>
            <table class="table datatable-pagination">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Parent category</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse( $categories as $key=> $category)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            @isset($category->images('featured')[0])
                            <img src="{{ asset('/storage/'.$category->images('featured')[0]->name)}}" height="100px" width="100px" alt="{{ $category->title }}"/>
                            @else
                            <img src="{{ asset('/backend/images/noimages.png')}}" style="width:120px;height:110px" alt="No Image found"/>
                            @endisset
                        </td>
                        <td>{{$category->title}}</td>
                        <td>{{$category->type->title}}</td>
                        <td>{{$category->parent ? $category->parent->title : 'None'}}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{route('categories.edit', $category->id) }}"
                                            class="dropdown-item"><i class="icon-pencil5"></i> Edit</a>
                                        <a href="#" class="dropdown-item"
                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this category?')){document.getElementById('delete-category-{{ $category->id }}-form').submit();}">
                                            <i class="icon-trash"></i>
                                            Delete
                                        </a>
                                        <form action="{{route('categories.destroy', $category->id) }}"
                                            id="delete-category-{{ $category->id }}-form" method="POST" style="display: none;">
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
                    <td colspan="12">
                        <div class="alert alert-info text-center">
                            No Categories Added So Far
                            <br>
                            <a href="{{ route('categories.create') }}" class="mt-2 btn btn-primary">
                                Add New Category
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('backend/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('backend/js/demo_pages/datatables_basic.js')}}"></script>
@endpush
