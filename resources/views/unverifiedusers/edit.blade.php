@extends('layouts.base')
@section('body')

<style>
  .modal-backdrop.fade {
opacity: 0;
filter: alpha(opacity=0);
}
.modal-backdrop.in {
opacity: 0.5;
filter: alpha(opacity=50);
}

...to this (added ".fade" between the two classes in the second definition):

.modal-backdrop.fade {
opacity: 0;
filter: alpha(opacity=0);
}
.modal-backdrop.fade.in {
opacity: 0.5;
filter: alpha(opacity=50);
}

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
        <!-- <button type="submit" class="btn btn-primary">Verify</button> -->
      </div>
     {!! Form::close() !!}
    
     @if ($unverifieduser->status != "Rejected")
     <form action="{{route('unverifieduser.reject',$unverifieduser->id)}}" method="POST" >
        @csrf
        @method('PUT')
        <!-- <div class="buttonreject"> -->
        <!-- {{ Form::submit('Reject',['class'=>'btn btn-primary']) }} -->
        <!-- <button type="submit" class="btn btn-primary">Reject</button>
       </div> -->

       <div class="container">
  <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal" id="open">Reject</button>
	<form action="{{route('unverifieduser.reject',$unverifieduser->id)}}" method="POST" >
        @csrf
        @method('PUT')

  <!-- Modal -->
  <div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="alert alert-danger" style="display:none"></div>
      <div class="modal-header">
      	
        <h5 class="modal-title">Choose the reason:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="input-box">
                <div class="form-group">
                  {!!Form::label(' ')!!}
                  {!! Form::select('message',array('Your ID mismatch with your information.' => 'Your ID mismatch with your information.', 'You already had existing account in the system.' => 'You already had existing account in the system.' , 'The photo of the ID you provided is blurry.' => 'The photo of the ID you provided is blurry.', 'The photo your selfies are blurry.' => 'The photo your selfies are blurry.' ),'',['class' => 'form-control'])!!}
                </div>
        </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger" >Confirm</button>
                <!-- {{ Form::submit('Rejected Again',['class'=>'btn btn-primary']) }} -->
              </div>
          </div>
        </div>
      </div>
        </form>
      </div>
      <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                    crossorigin="anonymous">
            </script>
            <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
            

      </form> 
      @elseif ($unverifieduser->status == "Rejected")
      <form action="{{route('unverifieduser.reject',$unverifieduser->id)}}" method="POST" >
        @csrf
        @method('PUT')
        <!-- <div class="buttonreject">
        {{ Form::submit('Rejected Again',['class'=>'btn btn-primary']) }}
        <button type="submit" class="btn btn-primary">Rejected Again</button>
        <button type="submit" id="rejected-button" class="btn btn-primary" onclick="otpRejected();">Rejected Again</button>
       </div> -->

        <div class="container">
        <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal" id="open">Rejected Again</button>
        <form action="{{route('unverifieduser.reject',$unverifieduser->id)}}" method="POST" >
              @csrf
              @method('PUT')

        <!-- Modal -->
        <div class="modal" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="alert alert-danger" style="display:none"></div>
            <div class="modal-header">
              
              <h5 class="modal-title">Choose the reason:</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="input-box">
                      <div class="form-group">
                      {!!Form::label(' ')!!}
                        {!! Form::select('message',array('Your ID mismatch with your information' => 'Your ID mismatch with your information.', 'You already had existing account in the system.' => 'You already had existing account in the system.' , 'The photo of the ID you provided is blurry.' => 'The photo of the ID you provided is blurry.', 'The photo your selfies are blurry.' => 'The photo your selfies are blurry.' ),'',['class' => 'form-control'])!!}
                      </div>
              </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" >Confirm</button>
                      <!-- {{ Form::submit('Rejected Again',['class'=>'btn btn-primary']) }} -->
                    </div>
                </div>
              </div>
            </div>
              </form>
            </div>
            <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                          integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                          crossorigin="anonymous">
                  </script>
                  <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                  

            </form> 
      @endif

      <a href="{{url()->previous()}}" class="btn btn-default" role="button">Back</a>
   
    </div>
  </div>
</div>
@endsection




