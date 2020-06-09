@foreach($data as $image)
    @php
        $is_found = false;
    @endphp
        <div class=" col-md-3">
        @foreach ($selection as $element)
            @if ($element->id == $image->id)
                <div class=" box modal-image image card-img-top mb-2 select" data-id="{{$image->id}}" data-name="{{$image->name}}"
                style="background-image: url({{asset('/storage/'.$image->name)}}); position: relative; background-position: center;
                    background-size: cover;">
                    @php
                        $is_found = true;
                    @endphp
            @endif
        @endforeach
        @if (!$is_found)
            <div class="box modal-image image card-img-top mb-2" data-id="{{$image->id}}" data-name="{{$image->name}}"
            style="background-image: url({{asset('/storage/'.$image->name)}}); position: relative; background-position: center;
                background-size: cover;">
        @endif
                <p class="resolution"></p>
                <button class="btn btn-danger del-position" data-id="{{$image->id}}"
                        data-name="{{$image->name}}"
                        onclick="alert('Be careful it will remove this image from all places ?')"><i
                        class="icon-diff-removed"></i></button>
                <p class="image-text">{{$image->alt}}</p>
            </div>
        </div>
    @endforeach
<div class="col-md-12">
    @if($data)
        {{$images->links()}}
    @endif
</div>
        </div>
