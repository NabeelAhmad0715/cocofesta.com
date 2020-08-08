@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('admin.pages.home') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - Orders</span> - View All
    </h4>
@endsection

@section('breadcrumbs')
<div class="breadcrumb">
    <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
    <span class="breadcrumb-item"><a href="{{ route('orders.index') }}"> Orders </a></span>
    <span class="breadcrumb-item active">View All</span>
</div>
@endsection

@section('content')
@include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')
        <div class="card has-table">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Orders</h5>
            </div>
            <table class="table datatable-pagination">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order Number</th>
                        <th>Name</th>
                        <th>Product Name</th>
                        <th>Phone No</th>
                        <th>Price</th>
                        <th>Qunatity</th>
                        <th>Created At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse( $orderDetails as $key=> $orderDetail)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{ $orderDetail->order_number }}</td>
                        <td>{{ $orderDetail->order->fullname }}</td>
                        <td>{{ $orderDetail->post->title }}</td>
                        <td>{{ $orderDetail->order->phone }}</td>
                        <td>{{ $orderDetail->price }}</td>
                        <td>{{ $orderDetail->quantity }}</td>
                        <td>{{$orderDetail->created_at }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('orders.show',[$orderDetail->id]) }}" class="dropdown-item">
                                            <i class="icon-eye"></i>
                                            Show
                                        </a>
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
