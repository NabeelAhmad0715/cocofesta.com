@forelse($data as $image)
        <div class=" col-md-3">
            <div class="box modal-image image card-img-top mb-2" id="{{$image->id}}" data-name="{{$image->name}}"
            style="background-image: url({{asset('/storage/'.$image->name)}}); position: relative; background-position: center;
                background-size: cover;">
                <p class="resolution"></p>
                <button class="btn btn-danger deselectImage" data-id="{{$image->id}}" data-imageabletype="{{$imageableType}}" data-imagetype="{{$imageType}}" data-imageableid="{{$imageableId}}"
                        data-name="{{$image->name}}"><i
                        class=" icon-unlink2"></i></button>
                <p class="image-text">{{$image->alt}}</p>
            </div>
        </div>
    @empty
    @endforelse
