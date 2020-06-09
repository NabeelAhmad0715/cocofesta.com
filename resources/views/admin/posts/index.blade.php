@extends('admin.layouts.layout')

@section('heading')
    <h4>
        <a href="{{ route('admin.pages.home') }}">
            <i class="icon-arrow-left52 mr-2"></i>
        </a>
        <span class="font-weight-semibold">Home - {{$type->title}} Posts</span> - View All
    </h4>
@endsection

@section('breadcrumbs')
    <div class="breadcrumb">
        <a href="{{ route('admin.pages.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
        <span class="breadcrumb-item"><a href="{{ route('posts.index',['slug' => $type->slug]) }}">{{$type->title}} - Post </a></span>
        <span class="breadcrumb-item active">View All</span>
    </div>
@endsection

@section('content')
    @include('admin.partials.header')
    <div class="content">
        @include('common.partials.flash')
        <div class="card has-table">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">All {{ $type->title }} Posts</h5>
                <div class="header-elements">
                    <a href="{{ route('posts.create',['slug' => $type->slug]) }}" class="mt-2 btn btn-primary">
                        Create New Post
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table datatable-pagination">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>SubTitlle</th>
                            <th>Image</th>
                            <td>In Stock</td>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $key => $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->getMetaData('subtitle') }}</td>
                            <td>
                                @isset($post->getMetaData("featured_image")[0])
                                    <img src="{{asset('/storage/' . $post->getMetaData("featured_image"))}}" style="width:150px;height:100px" alt="{{ $post->title }}">
                                @endisset
                            </td>
                            <td class="data">
                                <select data-id="{{ $post->id }}" class="inStock form-control" name="in_stock"
                                    id="in_stock">
                                        <option {{ $post->in_stock == 1 ? 'selected' : '' }} value="1" name="hidden_in_stock" class="hidden_in_stock" id="hidden_in_stock" >Yes</option>
                                        <option {{ $post->in_stock == 0 ? 'selected' : '' }} value="0" name="hidden_in_stock" class="hidden_in_stock" id="hidden_in_stock">No</option>
                                </select>
                                <input type="hidden" class="post_id" name="post_id" id="post_id"
                                    value="{{ $post->id }}" />
                            </td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ route('posts.edit', [$type->slug, $post->id]) }}"
                                                class="dropdown-item"><i class="icon-pencil5"></i> Edit</a>
                                            <a href="#" class="dropdown-item"
                                                onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this post?')){document.getElementById('delete-post-{{ $post->id }}-form').submit();}">
                                                <i class="icon-trash"></i>
                                                Delete
                                            </a>
                                            <form action="{{ route('posts.destroy', [$type->slug, $post->id]) }}"
                                                id="delete-post-{{ $post->id }}-form" method="POST" style="display: none;">
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
                            <td colspan="7">
                                <div class="alert alert-info text-center">
                                    No Posts Added So Far
                                    <br>
                                    <a href="{{ route('posts.create',['slug' => $type->slug]) }}" class="mt-2 btn btn-primary">
                                        Create New Post
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('backend/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('backend/js/demo_pages/datatables_basic.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $('.inStock').change(function(in_stock){
            var post_id = this.getAttribute('data-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'get',
                url: "/admin/set-stock-status/" + post_id + "/" + in_stock.target.value,
                dataType: 'json',
                success:function(data){
                    if(data == 'done')
                    {
                    $('#in_stock').bootstrapToggle('on');
                    alert("Data Inserted");
                    }
                }
            });
        });
    </script>
@endpush
