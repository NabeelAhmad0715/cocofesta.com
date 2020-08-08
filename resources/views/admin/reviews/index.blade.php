@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('admin.pages.home') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - Reviews</span> - View All
    </h4>
@endsection

@section('breadcrumbs')
<div class="breadcrumb">
    <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
    <span class="breadcrumb-item"><a href="{{ route('reviews.index') }}"> Reviews </a></span>
    <span class="breadcrumb-item active">View All</span>
</div>
@endsection

@section('content')
@include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')
        <div class="card has-table">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Reviews</h5>
            </div>
            <table class="table datatable-pagination">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Product Name</th>
                        <th>Email</th>
                        <th>Rating</th>
                        <th>Message</th>
                        <th>Created At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse( $reviews as $key=> $review)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$review->user->name }}</td>
                        <td>{{$review->post->title }}</td>
                        <td>{{$review->user->email }}</td>
                        <td>{{$review->rating }}</td>
                        <td>{{$review->message }}</td>
                        <td>{{$review->created_at }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"
                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this review?')){document.getElementById('delete-review-{{ $review->id }}-form').submit();}">
                                            <i class="icon-trash"></i>
                                            Delete
                                        </a>
                                        <form action="{{route('reviews.destroy', $review->id) }}"
                                            id="delete-review-{{ $review->id }}-form" method="POST" style="display: none;">
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
                            No Reviews Added So Far
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
