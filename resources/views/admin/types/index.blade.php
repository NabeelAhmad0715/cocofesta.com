@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('admin.pages.home') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - Types</span> - View All
    </h4>
@endsection

@section('breadcrumbs')
    <div class="breadcrumb">
        <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item"><a href="{{ route('types.index') }}"> Types </a></span>
        <span class="breadcrumb-item active">View All</span>
    </div>
@endsection

@section('content')
    @include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')
        <div class="card has-table">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Types</h5>
                <div class="header-elements">
                    <a href="{{ route('types.create') }}" class="mt-2 btn btn-primary">
                        Add New Type
                    </a>
                </div>
            </div>

            <table class="table datatable-pagination">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Created At</th>
                        <th>Last Modified</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($types as $key=> $type)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            @isset($type->images('featured')[0])
                                <img src="{{asset('/storage/' . $type->images('featured')[0]->name)}}" style="width:150px;height:100px" alt="{{ $type->title }}">
                            @else
                                <img src="{{asset('/backend/images/noimage.png')}}" style="width:120px;height:110px" alt="No Image Found">
                            @endisset
                        </td>
                        <td>{{ $type->title }}</td>
                        <td>{{ $type->created_at }}</td>
                        <td>{{ $type->updated_at }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{route('types.edit',$type->id) }}"
                                            class="dropdown-item"><i class="icon-pencil5"></i> Edit</a>
                                        <a href="#" class="dropdown-item"
                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this type?')){document.getElementById('delete-type-{{ $type->id }}-form').submit();}">
                                            <i class="icon-trash"></i>
                                            Delete
                                        </a>
                                        <form action="{{route('types.destroy',$type->id) }}"
                                            id="delete-type-{{ $type->id }}-form" method="POST" style="display: none;">
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
                        <td colspan="6">
                            <div class="alert alert-info text-center">
                                No Types Added So Far
                                <br>
                                <a href="{{ route('types.create') }}" class="mt-2 btn btn-primary">
                                    Add New Type
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
