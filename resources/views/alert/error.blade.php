
@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
    @foreach($errors->all() as $err)
         {{$err}}<br>
    @endforeach
</div>

@endif