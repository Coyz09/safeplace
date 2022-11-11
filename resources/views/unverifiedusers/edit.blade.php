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


  
    form .buttonreject{
        height: 5px;
        margin: 5px;
        border-color: red;
    }

    form .buttonreject input{     
        border-radius: 5px;
        border: red;
        color: red;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
    }
    


   form .button{
        height: 45px;
        margin: 35px 0;
      
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




<div class="input-form">

  <div class="form-container">
    
      <div class="image-holder"></div>
      
      <form action="{{route('unverifieduser.update',$unverifieduser->id)}}" method="POST" >
        @csrf
        @method('PUT')

      <div class="title">Update Record</div>


      <h2>Status: {{$unverifieduser->status}}</h2>

      <div class="user-details">
          
              <div class="input-box">
                <div class="form-group">
                  {!!Form::label('First Name:')!!}
                  {!! Form::text('fname',$unverifieduser->fname,['class' => 'form-control', 'readonly' => 'true'])!!}
                </div>
              </div>

              <div class="input-box">
                <div class="form-group">
                  {!!Form::label('Middle Name:')!!}
                  {!! Form::text('mname',$unverifieduser->mname,['class' => 'form-control', 'readonly' => 'true'])!!}
                </div>
              </div>

              <div class="input-box">
                <div class="form-group">
                  {!!Form::label('Last Name:')!!}
                  {!! Form::text('lname',$unverifieduser->lname,['class' => 'form-control', 'readonly' => 'true'])!!}
                </div>
              </div>


              <div class="input-box">
                <div class="form-group">
                  {!!Form::label('Gender:')!!}
                  <!-- {!! Form::text('gender',$unverifieduser->gender,array('class' => 'form-control')) !!} -->
                  {!! Form::select('gender',array('Male' => 'Male', 'Female' => 'Female'), $unverifieduser->gender,['class' => 'form-control'])!!}
                </div>
              </div>

              <div class="input-box">
                <div class="form-group">
                  {!!Form::label('Birthdate:')!!}
                  {!! Form::date('birthdate',$unverifieduser->birthdate,['class' => 'form-control', 'readonly' => 'true'])!!}
                </div>
              </div>

         
              <div class="input-box">
                <div class="form-group">
                  {!!Form::label('Address:')!!}
                  {!! Form::text('address',$unverifieduser->address,['class' => 'form-control', 'readonly' => 'true'])!!}
                </div>
              </div>
    
           
              <div class="input-box">
                <div class="form-group">
                  {!!Form::label('Contact:')!!}
                  {!! Form::text('contact',$unverifieduser->contact,['class' => 'form-control', 'readonly' => 'true'])!!}
                </div>
              </div>

              <div class="input-box">
                <div class="form-group">
                  {!!Form::label('Email:')!!}
                  {!! Form::text('email',$unverifieduser->email,['class' => 'form-control', 'readonly' => 'true']) !!}
                </div>
              </div>

              <div class="input-box">
                <div class="form-group">
    
                  {!! Form::hidden('user_id',$unverifieduser->user_id,['class' => 'form-control', 'readonly' => 'true'])!!}
                </div>
              </div>

      <div class="button">
        {{ Form::submit('Verify',['class'=>'btn btn-primary']) }}
      </div>
     {!! Form::close() !!}
    
     @if ($unverifieduser->status != "Rejected")
     <form action="{{route('unverifieduser.reject',$unverifieduser->id)}}" method="POST" >
        @csrf
        @method('PUT')
        <div class="buttonreject">
        {{ Form::submit('Reject',['class'=>'btn btn-primary']) }}
       </div>
      </form> 
      @elseif ($unverifieduser->status == "Rejected")
      <form action="{{route('unverifieduser.reject',$unverifieduser->id)}}" method="POST" >
        @csrf
        @method('PUT')
        <div class="buttonreject">
        {{ Form::submit('Reject Again',['class'=>'btn btn-primary']) }}
       </div>
      </form> 
      @endif

      <a href="{{url()->previous()}}" class="btn btn-default" role="button">Back</a>
   
    </div>
  </div>
</div>
@endsection



