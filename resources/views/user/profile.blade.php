@extends('layouts.base')
@section('content')


<style>
    * {
    margin: 0;
    padding: 0
}

body {
    background-color: white
}

.card {
    width: 350px;
    background-color: #efefef;
    border: none;
    cursor: pointer;
    transition: all 0.5s;
}

.image img {
    transition: all 0.5s
}

.card:hover .image img {
    transform: scale(1.5)
}

.btn {
    height: 140px;
    width: 140px;
    border-radius: 50%
}

.name {
    font-size: 22px;
    font-weight: bold
}

.idd {
    font-size: 14px;
    font-weight: 600
}

.idd1 {
    font-size: 12px
}

.number {
    font-size: 22px;
    font-weight: bold
}

.follow {
    font-size: 12px;
    font-weight: 500;
    color: #444444
}

.btn1 {
    height: 60px;
    width: 150px;
    border: none;
    background-color: #008000;
    color: white;
    font-weight: bold;
    font-size: 15px
}

.btn2 {
    height: 60px;
    width: 150px;
    border: none;
    background-color: #FFA500;
    color: black;
    font-weight: bold;
    font-size: 15px
}

.buttonradius{border-radius: 12px;}

.text span {
    font-size: 13px;
    color: #545454;
    font-weight: 500
}

.icons i {
    font-size: 19px
}

hr .new1 {
    border: 1px solid
}

.join {
    font-size: 14px;
    color: black;
    justify-content: center;
    text-align: center;
    font-family: Palatino, URW Palladio L, serif;
}


.date {
    background-color: #ccc
}
</style>


<div class="container mt-5 mb-4 p-3 d-flex justify-content-center"> 
    <div class="card p-4"> 
        <div class=" image d-flex flex-column justify-content-center align-items-center"> 
            <button class="btn btn-secondary"> <img src="{{asset($user->img)}}" height="100" width="100" /></button> <span class="name mt-3">{{$user->name}}</span> 
            <span class="idd">{{$users->email}}</span> 
            <div class="d-flex flex-row justify-content-center align-items-center gap-2">
             <span><i class="fa fa-phone"></i></span> <span class="idd1">{{$users->contact}}</span>
         </div> 
         <!-- <div class="d-flex flex-row justify-content-center align-items-center mt-3"> <span class="number">1069 <span class="follow">Followers</span></span> 
        </div> 
       -->
      <!-- <div class="text mt-2"> <span>Full Name: {{$user->name}}</span> 
      <div class="text mt-1"> <span>Gender: {{$users->gender}}</span> 
      <div class="text mt-1"> <span>Address: {{$users->address}}</span>  -->
        </div> 
        <div class="row">
        <div class=" d-flex mt-3 col-md-6"> <button class="btn1 buttonradius btn-dark"> <span><i class="fa fa-download"></i></span>Download Mobile app</button>
        </div>
        <div class=" d-flex mt-3 col-md-6">  <a href="{{ route('user.editprofile',$user->id) }}" class="btn2 buttonradius btn-dark">
        <button class="btn2 buttonradius btn-dark"> <span><i class="fa fa-edit"></i></span>Update Profile</button></a>
        </div>
        </div>
        <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center"> </div>
        <div class=" join "> <span class="join">Download and Install the mobile version to experience all the features of SAFEPLACE.</span> </div> 

        
        <a href="{{ route('user.logout') }}" class="log-out">
          <i class='text-light bx bx-log-out'></i>
        </a>
    </div> 
   
     
           
              
         
  
    
    </div>
      
</div>

<div class="container mt-5 mb-4 p-2 justify-content-center"> 
            <div class="row mt-5 text-center">
                {!! $qrcode !!}
            </div>
        </div>

@endsection






