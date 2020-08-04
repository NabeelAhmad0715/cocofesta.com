@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('admin.pages.home') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - Contact Enquiries</span> - View All
    </h4>
@endsection

@section('breadcrumbs')
    <div class="breadcrumb">
        <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item">Contact Enquiries</span>
        <span class="breadcrumb-item active">View All</span>
    </div>
@endsection

@section('content')
    @include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')
        <div class="card has-table">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">All Contact Enquiries</h5>
            </div>

            <table class="table datatable-pagination">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Comment</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contactEnquiries as $key =>  $contactEnquiry)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $contactEnquiry->name }}</td>
                        <td>{{ $contactEnquiry->email }}</td>
                        <td>{{ $contactEnquiry->phone }}</td>
                        <td style="width:300px"> {{ $contactEnquiry->comment }} </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <form action="{{route('contact-enquiries.destroy',$contactEnquiry->id) }}"   method="POST">
                                    @csrf
                                    @method('Delete')
                                    <button type="submit" class=" list-icons-item text-danger-600" onclick="return confirm('Are you sure you want to delete this Contact Inquiry?')" style="background-color: Transparent; border: none;cursor:pointer;"><i class="icon-trash"></i></button>
                                </form>
                            </div>
                        </td>
                        <td style="display: none"></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="alert alert-info text-center">
                                No Contact Enquiries So Far
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
