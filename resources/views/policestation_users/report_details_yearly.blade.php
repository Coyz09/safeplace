@extends('layouts.base')
@section('body')


{{-- <div class="container-xl">
    <p>{{$police_reports->report_details}}</p>
</div> --}}


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
          margin-bottom: 15px;
      }

      .container .title2{
          font-size: 19px;
          font-weight: 500;
          position: relative;
          margin-bottom: 22px;
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


<div class="input-form">

    <div class="form-container">

        <div class="image-holder"></div>
         
     

        <form action="" method="POST" >
          @csrf
          @method('PUT')

        <!-- <div class="title">Report Details: -->
        <div class="title">Report ID: {{$police_reports->id}}</div>   
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

        


      <!-- <div class="button">
        {{ Form::submit('Update',['class'=>'btn btn-primary']) }}
      </div> -->

      <a href="{{url()->previous()}}" class="btn btn-primary" role="button"> Back</a>


      {!! Form::close() !!}

    </div>
</div>








@endsection


