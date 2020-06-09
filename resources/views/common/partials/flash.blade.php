
@if (Session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {!!Session('success')!!}
    </div>
@endif


@if (Session('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {!!Session('warning')!!}
    </div>
@endif

@if (Session('danger'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {!!Session('danger')!!}
    </div>
@endif

@if ($errors->any())
        {!! implode('', $errors->all('<div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>:message</div>')) !!}
@endif

@if (session('message'))
    <div class="alert {{ session('alert-class', 'alert-info') }} border-0 alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        {!! session('message') !!}
    </div>
@endif
