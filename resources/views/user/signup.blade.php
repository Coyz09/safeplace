@extends('layouts.base')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Sign Up</h1>
              @include('layouts.flash-messages')

            <!-- <form class="" action="{{ route('user.signup') }}" files = "true" method="post"> -->
            {!! Form::open(['route' => 'user.signup', 'files' => true]) !!}
                {{ csrf_field() }}

                 <div class="form-group">
                    <label for="fname">First Name: </label>
                    <input type="text" name="fname" id="fname" class="form-control">
                </div>

                <div class="form-group">
                    <label for="lname">Middle Name: </label>
                    <input type="text" name="mname" id="mname" class="form-control">
                </div>

                <div class="form-group">
                    <label for="lname">Last Name: </label>
                    <input type="text" name="lname" id="lname" class="form-control">
                </div>

                <div class="form-group">
                    <label for="birthdate">Birthdate: </label>
                    <input type="date" name="birthdate" id="birthdate" class="form-control">
                </div>

                <div class="form-group">
                    <label for="gender">Gender: </label>
                  
                    {!! Form::select('gender',array('Male' => 'Male', 'Female' => 'Female'), null ,['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label for="contact">Contact: </label>
                    <input type="text" name="contact" id="contact" class="form-control">
                </div>

                <div class="form-group">
                    <label for="address">Address: </label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>


                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>


                <div class="form-group ">
                    <!-- <label for="password">Password: </label>
                    <input type="file" name="img" id="img" class="form-control"> -->
                    {!!Form::label('Select image to upload:')!!}
                    {!! Form::file('img', ['class' => 'form-control']); !!}
                    @if($errors->has('img'))
                    <a>{{ $errors->first('img') }}</a>
                    @endif
                </div>

                    <input type="submit" value="Sign Up" class="btn btn-primary">
             </form>
        </div>
    </div>
@endsection 











