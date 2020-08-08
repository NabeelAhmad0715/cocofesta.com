@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('admin.pages.home') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - Customers</span> - View All
    </h4>
@endsection

@section('breadcrumbs')
<div class="breadcrumb">
    <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
    <span class="breadcrumb-item"><a href="{{ route('customers.index') }}"> Customers </a></span>
    <span class="breadcrumb-item active">View All</span>
</div>
@endsection

@section('content')
@include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')
        <div class="card has-table">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Customers</h5>
            </div>
            <table class="table datatable-pagination">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Modified At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse( $customers as $key=> $customer)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$customer->name }}</td>
                        <td>{{$customer->email }}</td>
                        <td class="data">
                            <select data-id="{{ $customer->id }}" class="activeInactive form-control" name="is_active"
                                id="is_active">
                                    <option {{ $customer->is_active == 1 ? 'selected' : '' }} value="1" name="hidden_is_active" class="hidden_is_active" id="hidden_is_active" >Active</option>
                                    <option {{ $customer->is_active == 0 ? 'selected' : '' }} value="0" name="hidden_is_active" class="hidden_is_active" id="hidden_is_active">Inactive</option>
                            </select>
                            <input type="hidden" class="customer_id" name="customer_id" id="customer_id"
                                value="{{ $customer->id }}" />
                        </td>
                        <td>{{$customer->created_at }}</td>
                        <td>{{$customer->updated_at }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"
                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this customer?')){document.getElementById('delete-customer-{{ $customer->id }}-form').submit();}">
                                            <i class="icon-trash"></i>
                                            Delete
                                        </a>
                                        <form action="{{route('customers.destroy', $customer->id) }}"
                                            id="delete-customer-{{ $customer->id }}-form" method="POST" style="display: none;">
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
                            No Customers Added So Far
                            <br>
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
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $('.activeInactive').change(function(is_active){
            var customer_id = this.getAttribute('data-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'get',
                url: "/admin/" + customer_id + "/set-status/" + is_active.target.value,
                dataType: 'json',
                success:function(data){
                    if(data == 'done')
                    {
                    $('#is_active').bootstrapToggle('on');
                    alert("Data Inserted");
                    }
                }
            });
        });
    </script>
@endpush
