@if($errors->any())
<div>
    <span class="text-danger">Please fix the following errors before submitting the form again:</span>
    <ul>
        {!! implode('', $errors->all('<li class="text-danger">:message</li>')) !!}
    </ul>
</div>
@endif
