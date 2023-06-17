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

    .hide {
    display: none;
    }

    .btn-info {
        background-color: green;
        border-color: green;
    }
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

.card2 {
    width: 550px;
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

/* .btn{
    height: 140px;
    width: 140px;
   
} */

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
    background-color: #00BFFF;
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

.name {
    text-align: center;
}

</style>

 @include('layouts.flash-messages')   
<div class="container mt-5 mb-4 p-5 d-flex justify-content-center"  > 
    
    <div class="card p-4" style="left: 70px;"> 
        <div class=" image d-flex flex-column justify-content-center align-items-center"> 
            <button class="btn btn-secondary" style="height: 140px; width: 140px;"> <img src="{{asset($user->img)}}" height="100" width="100" /></button> <span class="name">{{$user->name}}</span> 
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
        <div class=" d-flex mt-3 col-md-6"><a href="public/apk/safeplace.apk"><button class="btn1 buttonradius btn-dark">    <span><i class="fa fa-download"></i></span>Download Mobile app</button></a>
        </div>
        <div class=" d-flex mt-3 col-md-6">  
            <!-- <a href="{{ route('user.editprofile',$user->id) }}" class="btn2 buttonradius btn-dark">
        <button class="btn2 buttonradius btn-dark"> <span><i class="fa fa-edit"></i></span>Update Profile</button></a> -->
        <button type="button" class="btn2 buttonradius btn-dark" data-toggle="modal" data-target="#myModal" ><span><i class="fa fa-edit"></i></span>Change Password</button>
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

<div class="container mt-5 mb-4 p-5 justify-content-center">
<div class="card2 p-4">
            <h2 class="row mt-2 text-center justify-content-center align-items-center"> <strong> SAFEPLACE </strong> </h2>
            <div class="row mt-2 text-center justify-content-center align-items-center">

                {!! $qrcode !!}

            </div>

            <h3 class="row mt-3 mb-4 p-2 text-center justify-content-center align-items-center"><strong>Scan to login</strong></h3>
            <h5 class="row mt-1 text-center justify-content-center align-items-center">Download and Install the mobile app first and then</h5>
            <h5 class="row mt-1 text-center justify-content-center align-items-center"> Scan the QR Code to log in</h5>
            <h5 class="row mt-1 text-center justify-content-center align-items-center">instantly in your mobile device.</h5>
        </div>
        </div>

        <div class="form-group">
        <form action="{{route('user.updateprofile',$user->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        
        @method('PUT')
        <!-- Modal -->
        <div class="modal" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert alert-danger" style="display:none"></div>
                <div class="modal-header">

                    <h5 class="modal-title">Please Verify Phone number to proceed.</h5>
                    <!-- <h4>Please Verify Phone number to proceed.</h4> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="alert alert-danger hide" id="error-message"></div>
                        <div class="alert alert-success hide" id="sent-message"></div>

                        <div class="form-group">
                            <div class="card mt-3">
                                <div class="card-body">

                                        <div class="mb-3">
                                            <label for="contact" class="form-label">Phone Number:</label>
                                            <input type="text" id="contact" name="contact" value= "{{$users->contact}}"  class="form-control" placeholder="+639XXXXXXXXXX">
                                        </div>
                                        <div id="recaptcha-container"></div>
                                        <button type="button" id="otp-button" class="btn btn-info" onclick="otpSend();">Verify Phone Number</button>

                                </div>
                            </div>
                            <div id="otp-codes" class="card mt-3 hide">
                                <div class="card-body">

                                        <div class="mb-3">
                                            <label for="otp-code" class="form-label">OTP code:</label>
                                            <input type="text" id="otp-code" class="form-control" placeholder="Enter OTP Code">
                                        </div>
                                        <button type="button" class="btn btn-info" onclick="otpVerify();">Verify OTP</button>

                                </div>
                            </div>
                                    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
                                    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-auth.js"></script>
                                    <script type="text/javascript">
                                        const config = {

                                            apiKey: "AIzaSyD1FsINq1NWB1Mu3E3t00p7PJFaIWFdj20",
                                            authDomain: "safeplace-4fa43.firebaseapp.com",
                                            projectId: "safeplace-4fa43",
                                            storageBucket: "safeplace-4fa43.appspot.com",
                                            messagingSenderId: "1053701644301",
                                            appId: "1:1053701644301:web:7c501710f80653d78c3544",
                                            measurementId: "G-LX40NYFV43"

                                        };

                                        firebase.initializeApp(config);
                                    </script>

                                    <script type="text/javascript">
                                        // reCAPTCHA widget
                                        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                                            'size': 'invisible',
                                            'callback': (response) => {
                                                // reCAPTCHA solved, allow signInWithPhoneNumber.
                                                onSignInSubmit();
                                            }
                                        });

                                        function otpSend() {
                                            var phoneNumber = document.getElementById('contact').value;
                                            const appVerifier = window.recaptchaVerifier;
                                            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                                                .then((confirmationResult) => {
                                                    // SMS sent. Prompt user to type the code from the message, then sign the
                                                    // user in with confirmationResult.confirm(code).
                                                    window.confirmationResult = confirmationResult;

                                                    document.getElementById("sent-message").innerHTML = "Message sent succesfully.";
                                                    document.getElementById("sent-message").classList.add("d-block");
                                                    document.getElementById("error-message").classList.remove("d-block");
                                                    // document.getElementById("signup").disabled = false;
                                                    // document.getElementById("signup").setAttribute("type", "submit");
                                                    document.getElementById("otp-codes").classList.add("d-block");
                                                }).catch((error) => {
                                                    document.getElementById("error-message").innerHTML = error.message;
                                                    document.getElementById("error-message").classList.add("d-block");
                                                    document.getElementById("sent-message").classList.remove("d-block");
                                                    document.getElementById("open").disabled = true;
                                                    document.getElementById("open").setAttribute("hidden", "hidden");
                                                    document.getElementById("otp-codes").classList.remove("d-block");
                                                });
                                        }

                                        function otpVerify() {
                                            var code = document.getElementById('otp-code').value;
                                            confirmationResult.confirm(code).then(function (result) {
                                                // User signed in successfully.
                                                var user = result.user;

                                                document.getElementById("sent-message").innerHTML = "Phone number succesfully verified.";
                                                document.getElementById("sent-message").classList.add("d-block");
                                                document.getElementById("error-message").classList.remove("d-block");

                                                document.getElementById("proceed").removeAttribute("hidden");
                                                document.getElementById("proceed").disabled = false;

                                                document.getElementById("otp-codes").classList.remove("d-block");
                                                document.getElementById("otp-button").style.visibility = 'hidden';
                                                document.getElementById("otp-button").disabled = true;

                                            }).catch(function (error) {
                                                document.getElementById("error-message").innerHTML = error.message;
                                                document.getElementById("error-message").classList.add("d-block");
                                                document.getElementById("sent-message").classList.remove("d-block");
                                                document.getElementById("proceed").disabled = true;
                                                document.getElementById("proceed").setAttribute("hidden", "hidden");

                                            });
                                        }
                                    </script>
                            </div>

                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="submit" class="btn btn-danger" >Confirm</button> -->
                        <button type="button" hidden disabled ="true" id="proceed" name="proceed" class="btn btn-success" data-toggle="modal" data-target="#credentials"  data-dismiss="modal">Proceed</button>
                            <!-- {{ Form::submit('Rejected Again',['class'=>'btn btn-primary']) }} -->
                        </div>
                    </div>
                    </div>
                </div>

                </div>

                    <div class="form-group">
                    <!-- Modal -->
                    <div class="modal" tabindex="-1" role="dialog" id="credentials">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="alert alert-danger" style="display:none"></div>
                        <div class="modal-header">

                            <h5 class="modal-title">Change Password:</h5>
                            <!-- <h4>Please Verify Phone number to proceed.</h4> -->
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="form-group">
                        <div class="card">
                        <div class="card-body">
                            <label for="password">New Password: </label>
                            <input type="password" name="password" id="password" value="{{ old('password')}}" class="form-control">
                            </div>
                        </div>
                        </div>


                            <input type="hidden" disabled ="true" id="signup" name="signup" value="Sign Up" class="btn btn-primary">

                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal" data-dismiss="modal">Back</button>

                                <button type="submit" class="btn btn-success" >Confirm</button>
                                    <!-- {{ Form::submit('Rejected Again',['class'=>'btn btn-primary']) }} -->
                                </div>
                            </div>
                            </div>
                        </div>
                            </form>
                        </div>

                    </form>

   
                <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                                    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                                    crossorigin="anonymous">
                 </script>
                            <!-- Latest compiled and minified JavaScript -->
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                </div>


@endsection






