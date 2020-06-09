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
                <h5 class="card-title">All Types</h5>
                <div class="header-elements">
                    <a href="{{ route('types.create') }}" class="mt-2 btn btn-primary">
                        Create New Type
                    </a>
                </div>
            </div>

            <table class="table datatable-pagination">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Introduction</th>
                        <th>created_at</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($types as $type)
                    <tr>
                        <td>
                            @isset($type->images('featured')[0])
                            <img src="{{asset('/storage/' . $type->images('featured')[0]->name)}}" style="width:150px;height:100px" alt="{{ $type->title }}">
                            @endisset
                        </td>
                        <td>{{ $type->title }}</td>
                        <td style="width:300px"> {!! $type->introduction !!} </td>
                        <td>{{ $type->created_at }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <a href="{{route('types.edit',$type->id) }}" class="list-icons-item text-primary-600"><i class="icon-pencil7"></i></a>
                                <form action="{{route('types.destroy',$type->id) }}"   method="POST">
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class=" list-icons-item text-danger-600" onclick="return confirm('Are you sure you want to delete this type?')" style="background-color: Transparent; border: none;cursor:pointer;"><i class="icon-trash"></i></button>
                                </form>
                            </div>
                        </td>
                        <td style="display: none"></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="alert alert-info text-center">
                                No Types Added So Far
                                <br>
                                <a href="{{ route('types.create') }}" class="mt-2 btn btn-primary">
                                    Create New
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
