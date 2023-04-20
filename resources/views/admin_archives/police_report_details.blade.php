@extends('layouts.base')
@section('body')


{{-- <div class="container-xl">
    <p>{{$police_reports->report_details}}</p>
</div> --}}


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
        font-size: 40px;
        font-weight: 500;
        margin-bottom: 15px;
    }

  .container .title2{
        font-size: 25px;
        font-weight: 500;
        position: relative;
        margin-bottom: 10px;
    }

  .input-form {
  padding: 80px 0;
  }

  .input-form .image-holder {
    display: table-cell;
    width: auto;
    height: 500px;
    /* background-image: url('../../Images/3d2.png'); */
    background-size: cover;
    background-color: #e0ffed;
    padding: 100px 60px;
  }

  .input-form .form-container {
    display: table;
    height: 600px;
    max-width: 5000px;
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
    background: #037e37;
    border: none;
    border-radius: 4px;
    padding: 11px;
    box-shadow: none;
    margin-top: 35px;
    text-shadow: none;
    outline: none !important;
  }

  .input-form form .btn-primary2 {
    background: #00BFFF;
    border: none;
    border-radius: 4px;
    padding: 11px;
    box-shadow: none;
    margin-top: 35px;
    text-shadow: none;
    outline: none !important;
  }

  .input-form form .btn-warning {
    background: yellow;
    border: none;
    border-radius: 4px;
    padding: 11px;
    box-shadow: none;
    margin-top: 35px;
    text-shadow: none;
    outline: none !important;
  }

  .input-form form .btn-primary:hover, .input-form form .btn-primary:active {
    background: #02b84e;
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

        <div class="image-holder">
        <div class="form-group">
          
        <div style ="text-align: center;" class="title">Report Details:</div>
            {!! Form::textarea('report_details',$police_reports->report_details,['class' => 'form-control', 'readonly' => 'true'])!!}
          </div>

          <div class="form-group">
            <h5>Report Images:</h5>
            <button class="btn btn-secondary"> <img src="{{asset($police_reports->report_images_1)}}" height="100%" width="100%" /></button> 
            <button class="btn btn-secondary"> <img src="{{asset($police_reports->report_images_2)}}" height="100%" width="100%" /></button> 
            <button class="btn btn-secondary"> <img src="{{asset($police_reports->report_images_3)}}" height="100%" width="100%" /></button> 
        </div>

    <div style ="text-align: center;" class="title">User Details:</div>
                    
                    <div class="input-box" style ="text-align: center;">
                      <div class="form-group" style ="text-align: center;">
                    
       
                        <h4 style ="text-align: center;">Complainant ID:</h4>
                          {!! Form::text('complainant_id',$police_reports->complainant_id,['class' => 'form-control', 'readonly' => 'true'])!!}
                        </div>
             
          
                      <div class="form-group">
                      
                      <h4 style ="text-align: center;">Complainant Name:<h4>
                        {!! Form::text('complainant_name',$police_reports->complainant_name,['class' => 'form-control', 'readonly' => 'true'])!!}
                      </div>
             
                      </div>
          
                      <div class="form-group">
            
                      <h4 style ="text-align: center;">Complainant Address:<h4>
                        {!! Form::text('complainant_address',$police_reports->complainant_address,['class' => 'form-control', 'readonly' => 'true'])!!}
                      </div>
               
          
                      <div class="form-group">
                 
                      <h4 style ="text-align: center;">Complainant Age:<h4>
                        {!! Form::text('complainant_age',$police_reports->complainant_age,['class' => 'form-control', 'readonly' => 'true'])!!}
                      </div>
         
          
                      <div class="form-group">
                  
                      <h4 style ="text-align: center;">Complainant Gender:<h4>
                        {!! Form::text('complainant_gender',$police_reports->complainant_gender,['class' => 'form-control', 'readonly' => 'true'])!!}
                      </div>
                
                      
                      <div class="form-group">
                     
                      <h4 style ="text-align: center;">Complainant Contact:<h4>
                        {!! Form::text('complainant_contact',$police_reports->complainant_contact,['class' => 'form-control', 'readonly' => 'true'])!!}
                      </div>
                
          
                      <div class="form-group">
                    
                      <h4 style ="text-align: center;">Complainant Email:<h4>
                        {!! Form::text('complainant_email',$police_reports->complainant_email,['class' => 'form-control', 'readonly' => 'true'])!!}
                      </div>
                
        </div>

      
        <form action="{{route('policestation_user.update',$police_reports->id)}}" method="POST" >
          @csrf
          @method('PUT')


        <div class="title2">Report ID: {{$police_reports->id}}</div>   
        <div class="title2">Report Status: {{$police_reports->report_status}}</div>
    

        <div class="user-details">

        <div class="input-box">
                  <div class="form-group">
                    {!!Form::label('Barangay:')!!}
                    {!! Form::text('barangay',$police_reports->barangay,['class' => 'form-control', 'readonly' => 'true'])!!}
                 </div>
                </div>

                <div class="input-box">
                    <div class="form-group">
                      {!!Form::label('Street:')!!}
                      {!! Form::text('street',$police_reports->street,['class' => 'form-control', 'readonly' => 'true'])!!}
                  </div>
                </div>

                <div class="input-box">
                    <div class="form-group">
                      {!!Form::label('Police Substation:')!!}
                      {!! Form::text('police_substation',$police_reports->police_substation,['class' => 'form-control', 'readonly' => 'true'])!!}
                  </div>
                </div>

                <div class="input-box">
                  <div class="form-group">
                    {!!Form::label('Date Reported:')!!}
                    {!! Form::text('date_reported',$police_reports->date_reported,array('class' => 'form-control')) !!}
                  </div>
                </div>

                <div class="input-box">
                  <div class="form-group">
                    {!!Form::label('Time Reported:')!!}
                    {!! Form::text('date_reported',$police_reports->time_reported,array('class' => 'form-control')) !!}
                  </div>
                </div>

                <div class="input-box">
                  <div class="form-group">
                    {!!Form::label('Year Reported:')!!}
                    {!! Form::text('year_reported',$police_reports->year_reported,array('class' => 'form-control')) !!}
                  </div>
                </div>

                <div class="input-box">
                  <div class="form-group">
                    {!!Form::label('Date Committed:')!!}
                    {!! Form::text('date_committed',$police_reports->date_commited,array('class' => 'form-control')) !!}
                  </div>
                </div>

                <div class="input-box">
                  <div class="form-group">
                    {!!Form::label('Time Committed:')!!}
                    {!! Form::text('time_commited',$police_reports->time_commited,array('class' => 'form-control')) !!}
                  </div>
                </div>


        </div>

<!--     
      <div class="button">
        
        {{ Form::submit('Respond',['class'=>'btn btn-primary']) }}
      </div> -->
      <a href="{{url()->previous()}}" class="btn btn-primary2" role="button"> Back</a>
      {!! Form::close() !!}


</div>
</div>



@endsection


