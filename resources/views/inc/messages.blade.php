@if(count($errors) > 0)
 @foreach($errors->all() as $error)
    <div class="alert alert-danger">
        {{$error}}
    </div>
 @endforeach
 @endif

 @if(session('alert'))
    <div class="alert alert-danger" style="text-align: center;">
        {{ session('alert') }}
    </div>
@endif

@if(session('success'))
<div class="alert alert-success" style="text-align: center;">
    {{ session('success') }}
</div>
@endif