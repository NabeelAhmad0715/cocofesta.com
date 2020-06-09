<!-- Large modal -->
<div id="image-utility" class="modal fade" tabindex="-1" style="overflow-y: auto;">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content" style="max-height: 90vh;">
            <div class="modal-header text-center">
                <h3 class="text-left m-auto pb-2">Image Manager</h3>
                <button type="button" class="close pt-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 45px;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-responsive bg-light border-top">
                    <ul class="nav nav-tabs nav-tabs-bottom flex-nowrap mb-0">
                        <li class="nav-item">
                            <a href="#uploader" class="nav-link active" data-toggle="tab">
                                <i class="icon-file-upload mr-2"></i>
                                Upload File
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#gallery" class="nav-link" data-toggle="tab">
                                <i class="icon-images3 mr-2"></i>
                                Gallery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#selected-image" class="nav-link" data-toggle="tab">
                                <i class="icon-file-picture mr-2"></i>
                                Selected Image
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="uploader">
                        <form method="post" id="imageForm" class="form-horizontal mt-5" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Image:</label>
                                <input type="file" name="image" class="form-input-styled" id="file" data-fouc>
                                <span class="form-text text-muted">Accepted formats: jpeg, png</span>
                            </div>
                            <div class="form-group">
                                <label for="alt">Alt:</label>
                                <input type="text" name="alt" class="form-control" id="alt">
                            </div>
                            <div class="form-group">
                                <label for="credits">Credits:</label>
                                <textarea type="text" class="form-control tinymce" id="credits"
                                          name="credit"></textarea>
                            </div>
                            <button type="submit" id="upload" class="btn btn-primary float-left">Upload</button>
                        </form>
                    </div>
                    <div class="tab-pane fade show mt-4" id="gallery">
                        <div class="alert alert-success" id="message" style="display:none;"></div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-lg" name="search" id="searchInput"
                                       placeholder="Search image by name...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn bg-primary-600 btn-icon btn-lg" id="searchButton">
                                        <i class="icon-search4"></i></button>
                                </div>
                            </div>

                            <div class="col-md-4 form-group">
                                <label class="d-block">Search by:</label>
                                <select class="form-control select-fixed-single image-filter" id="search-by" data-fouc>
                                    <option value="name">Name</option>
                                    <option value="created_at">Create Date</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="d-block">Order By:</label>
                                <select class="form-control select-fixed-single image-filter" id="order-by" data-fouc>
                                    <option value="ASC">Ascending</option>
                                    <option value="DESC">Descending</option>
                                </select>
                            </div>

                            <input type="hidden" name="hidden_page" id="hidden_page" value="1"/>
                        </div>
                        <div class="row" id="imageUpload">
                            @forelse($images as $image)
                                <div class=" col-md-3">
                                    <div class=" box modal-image image card-img-top mb-2" data-id="{{$image->id}}"
                                         data-name="{{$image->name}}"
                                         style="background-image: url({{asset('/storage/'.$image->name)}}); position: relative; background-position: center;
                                             background-size: cover; background-repeat: no-repeat">
                                        <p class="resolution"></p>
                                        <button class="btn btn-danger del-position" data-id="{{$image->id}}"
                                                data-name="{{$image->name}}"
                                                onclick="return confirm('Be careful it will remove this image from all places ?')">
                                            <i class="icon-diff-removed"></i></button>
                                        <p class="image-text">{{$image->alt}}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center">
                                    <h6>No Image found</h6>
                                </div>
                            @endforelse
                            <div class="col-md-12">
                                @if($images)
                                    {{ $images->links() }}
                                @endif
                            </div>

                        </div>
                        <div class="modal-footer"
                             style="position: -webkit-sticky; /* Safari */ position: sticky; bottom: -22px; padding: 20px 0px; background-color: white">
                            <button class="btn btn-primary" id="confirm-button">Confirm</button>
                            <button type="button" class="btn bg-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <div class="tab-pane fade show mt-4" id="selected-image">
                        <div class="alert alert-success" id="message" style="display:none;"></div>
                        <div class="row" id="SelectedImages">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /large modal -->



@push('scripts')
    <script src="{{ asset('backend/js/image-utility.js') }}"></script>
    <script src="{{asset('backend/js/demo_pages/form_select2.js')}}"></script>
    <script src="{{asset('backend/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('backend/js/demo_pages/form_layouts.js')}}"></script>
    <script src="{{asset('backend/js/demo_pages/components_modals.js')}}"></script>
@endpush
