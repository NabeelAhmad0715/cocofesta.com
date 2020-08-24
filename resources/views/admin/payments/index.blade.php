@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('admin.pages.home') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - Payments</span> - View All
    </h4>
@endsection

@section('breadcrumbs')
<div class="breadcrumb">
    <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
    <span class="breadcrumb-item"><a href="{{ route('payments.index') }}"> Payments </a></span>
    <span class="breadcrumb-item active">View All</span>
</div>
@endsection

@section('content')
@include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')
        <div class="card has-table">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Payments</h5>
            </div>
            <table class="table datatable-pagination">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Payment Id</th>
                        <th>Payer Id</th>
                        <th>Payer Email</th>
                        <th>Amount</th>
                        <th>Currency</th>
                        <th>Payment Status</th>
                        <th>Created At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse( $payments as $key=> $payment)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{ $payment->payment_id }}</td>
                        <td>{{ $payment->payer_id }}</td>
                        <td>{{ $payment->payer_email }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->currency }}</td>
                        <td>{{ $payment->payment_status }}</td>
                        <td>{{$payment->created_at }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{route('payments.order',[$payment])}}" class="dropdown-item">
                                            <i class="icon-eye"></i>
                                            Show Order
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
                            No Payments Added So Far
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
