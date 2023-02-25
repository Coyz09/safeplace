@extends('layouts.base')
@section('body')


<style>

  .default{
    margin-left: 200px;
  }
  
  body{
    background: rgb(203, 207, 207);
  }

  .container .title{
        font-size: 25px;
        font-weight: 500;
        position: relative;
        margin-bottom: 60px;
    }

  .input-form {
  padding: 80px 0;
  }

  .input-form .image-holder {
    display: table-cell;
    width: auto;
    height: 500px;
    background-image: url('../../Images/3d2.png');
    background-size: cover;
  }

  .input-form .form-container {
    display: table;
    height: 600px;
    max-width: 900px;
    width: 100%;
    margin: 0 auto;
    box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
  }

  .input-form form {
    display: table-cell;
    width: 400px;
    background-color: #ffffff;
    padding: 100px 60px;
    color: #505e6c;
  }

  @media (max-width:991px) {
    .input-form form {
      padding: 40px;
    }
  }

  .input-form form h2 {
    font-size: 24px;
    line-height: 1.5;
    margin-bottom: 30px;
  }

  .input-form form .form-control {
    background: #f7f9fc;
    border: none;
    border-bottom: 1px solid #dfe7f1;
    border-radius: 0;
    box-shadow: none;
    outline: none;
    color: inherit;
    text-indent: 6px;
    height: 40px;
  }

  .input-form form .form-check {
    font-size: 13px;
    line-height: 20px;
  }

  .input-form form .btn-primary {
    background: #6c6565;
    border: none;
    border-radius: 4px;
    padding: 11px;
    box-shadow: none;
    margin-top: 35px;
    text-shadow: none;
    outline: none !important;
  }

  .input-form form .btn-primary:hover, .input-form form .btn-primary:active {
    background: #037e37;
  }

  .input-form form .btn-primary:active {
    transform: translateY(1px);
  }

  .input-form form .already {
    display: block;
    text-align: center;
    font-size: 12px;
    color: #6f7a85;
    opacity: 0.9;
    text-decoration: none;
  }
  .content form .user-details{
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      margin: 20px 0 12px 0;
  }

  form .user-details .input-box{
      margin-bottom: 15px;
      width: 100%;
  }

  form .input-box span.details{
      display: block;
      font-weight: 500;
      margin-bottom: 5px;
  }

  .user-details .input-box input{
      height: 45px;
      width: 100%;
      outline: none;
      font-size: 16px;
      border-radius: 5px;
      padding-left: 15px;
      border: 1px solid #ccc;
      border-bottom-width: 2px;
      transition: all 0.3s ease;
  }

  .user-details .input-box input:focus,
  .user-details .input-box input:valid{
      border-color: #0d552c;
  }

   form .button{
        height: 45px;
        margin: 35px 0
    }

    form .button input{
        height: 100%;
        width: 100%;
        border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    form .button input:hover{
        /* transform: scale(0.99); */
    }

    form .user-details .input-box{
        margin-bottom: 15px;
        width: 100%;
    }



</style>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="input-form">

  <div class="form-container">
    
      <div class="image-holder"></div>

      <form action="{{route('policestation.update',$policestation->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

      <div class="title">Update Record</div>

      <div class="user-details">

      {{-- PoliceStation Name --}}
             <div class="input-box">
               <div class="form-group">
                 {!!Form::label('PoliceStation Name:')!!}
                 {!! Form::text('policestation_name',$policestation->policestation_name, ['class' => 'form-control']); !!}
               </div>
             </div>

             {{-- PoliceStation Captain --}}
             <div class="input-box">
               <div class="form-group">
                 {!!Form::label('PoliceStation Commander:')!!}
                 {!! Form::text('policestation_commander',$policestation->policestation_commander , ['class' => 'form-control']); !!}
               </div>
             </div>

             <!-- {{-- PoliceStation Location --}}
             <div class="input-box">
               <div class="form-group">
                 {!!Form::label('PoliceStation Location:')!!}
                 {!! Form::text('policestation_location', $policestation->policestation_location, ['class' => 'form-control']); !!}
               </div>
             </div> -->

             <div class="input-box">
             <div class="form-group">
             {!!Form::label('PoliceStation Location:')!!}
             <!-- {!! Form::text('address', $policestation->policestation_location, ['class' => 'form-control map-input ']); !!} -->
                <input class="form-control map-input {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{$policestation->policestation_location}}">
                <input type="hidden" name="latitude" id="address-latitude" value="{{ $policestation->latitude ?? '0' }}" />
                <input type="hidden" name="longitude" id="address-longitude" value="{{  $policestation->longitude ?? '0' }}" />
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
           
            </div>  
            </div>
            
            <div id="address-map-container" class="mb-2" style="width:100%;height:400px; ">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div>

             {{-- PoliceStation Schedule --}}
             <div class="input-box">
               <div class="form-group">
                 {!!Form::label('PoliceStation Schedule:')!!}
                 {!! Form::text('policestation_schedule',$policestation->policestation_schedule , ['class' => 'form-control']); !!}
               </div>
             </div>

             {{-- PoliceStation Contact --}}
             <div class="input-box">
               <div class="form-group">
                 {!!Form::label('PoliceStation Contact:')!!}
                 {!! Form::text('policestation_contact', $policestation->policestation_contact, ['class' => 'form-control']); !!}
               </div>
             </div>

             {{-- PoliceStation Email--}}
              <div class="input-box">
              @foreach ($emails as $email)
                <div class="form-group">
                  {!!Form::label('PoliceStation Email:')!!}
                  {!! Form::text('email',$email,array('class' => 'form-control')) !!}
                </div>
                @endforeach
              </div>


              {{-- PoliceStation Password --}}
              <div class="input-box">
              @foreach ($passwords as $password)
                <div class="form-group">
                  {!!Form::label('PoliceStation Password:')!!}
                  {!! Form::text('password',null,array('class' => 'form-control')) !!}
                </div>
                @endforeach
              </div>

              <div class="input-box">
                <div class="form-group">
                  {!! Form::hidden('user_id',$policestation->user_id,array('class' => 'form-control')) !!}
                </div>
              </div>

              <div class="input-box">
                <div class="form-group ">
                    {!!Form::label('Select image to upload:')!!}
                    {!! Form::file('img',['class' => 'form-control']); !!}
                    @if($errors->has('img'))
                    <a>{{ $errors->first('img') }}</a>
                    @endif
                </div>
                </div> 
    
      </div>
    

    <div class="button">
      {{ Form::submit('Update',['class'=>'btn btn-primary']) }}
    </div>

    <a href="{{url()->previous()}}" class="btn btn-default" role="button">Back</a>
    {!! Form::close() !!}
    
  </div>
</div>
@endsection
@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize&language=en&region=GB" async defer></script>
<script src="/js/mapInput.js"></script>

@endsection


