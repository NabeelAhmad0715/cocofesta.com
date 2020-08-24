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
    <a href="{{ route('payments.index') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Payments</a>
    <span class="breadcrumb-item">Orders</span>
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
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $payment->order->fullname }}</td>
                        <td>{{ $payment->order->address }}</td>
                        <td>{{ $payment->order->phone }}</td>
                        <td>{{ $payment->order->email }}</td>
                        <td>{{ $payment->order->created_at }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{route('payments.order-details', [$payment->id, $payment->order->id])}}" class="dropdown-item">
                                            <i class="icon-eye"></i>
                                            Show Order Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
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
