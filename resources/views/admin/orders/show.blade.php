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
                        <th>Order Number</th>
                        <th>Name</th>
                        <th>Product Name</th>
                        <th>Phone No</th>
                        <th>Price</th>
                        <th>Qunatity</th>
                        <th>Address</th>
                        <th>Message</th>
                        <th>City</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $orderDetail->order_number }}</td>
                        <td>{{ $orderDetail->order->fullname }}</td>
                        <td>{{ $orderDetail->post->title }}</td>
                        <td>{{ $orderDetail->order->phone }}</td>
                        <td>{{ $orderDetail->price }}</td>
                        <td>{{ $orderDetail->quantity }}</td>
                        <td>{{ $orderDetail->order->address }}</td>
                        <td>{{ $orderDetail->order->message }}</td>
                        <td>{{ $orderDetail->order->city }}</td>
                        <td>{{$orderDetail->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('backend/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('backend/js/demo_pages/datatables_basic.js')}}"></script>
@endpush
