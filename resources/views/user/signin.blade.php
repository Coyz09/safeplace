@extends('layouts.login')
@section('content')


<div class="logo">
<a href="/"><img src="../../Images/forms/Logo.png"></a>
    <!-- @include('layouts.flash-messages') -->
</div>

<div class='wrap'>
    @include('layouts.flash-messages')  
   
    <form class="" action="{{ route('user.signin') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" name="email" id="email" class="form-control" placeholder="Email" value= "{{ old('email')}}">
            <!-- {!! Form::text('email', old('email'), ['class' => 'form-control']); !!} -->
        </div>

        <div class="form-group">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        </div>

            <input type="submit" value="LOGIN" class="btn-login">
     </form>

</div>



@endsection






