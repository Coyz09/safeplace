@extends('layouts.base')
@section('content')


    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Sign Up</h1>

            <style type="text/css">
            .hide {
                display: none;
            }
            </style>

            
          


   

              <!-- @include('layouts.flash-messages') -->
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


            {!! Form::open(['route' => 'user.signup', 'files' => true]) !!}
                {{ csrf_field() }}

                 <div class="form-group">
                    <label for="fname">First Name: </label>
                    <input type="text" name="fname" id="fname" value= "{{ old('fname')}}"  class="form-control">
                </div>

                <div class="form-group">
                    <label for="lname">Middle Name: </label>
                    <input type="text" name="mname" id="mname" value= "{{ old('mname')}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="lname">Last Name: </label>
                    <input type="text" name="lname" id="lname" value= "{{ old('lname')}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="birthdate">Birthdate: </label>
                    <input type="date" name="birthdate" id="birthdate" value= "{{ old('birthdate')}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="gender">Gender: </label>

                    {!! Form::select('gender',array('' => 'Choose your Gender:','Male' => 'Male', 'Female' => 'Female'), old('gender') ,['class' => 'form-control']) !!}
                </div>


                <!-- <div class="form-group">
                    <label for="contact">Contact: </label>
                    <input type="text" name="contact" id="contact" class="form-control">
                </div> -->
                
                <!-- <div class="alert alert-danger hide" id="error-message"></div>
            <div class="alert alert-success hide" id="sent-message"></div> -->

            <div class="alert alert-danger hide" id="error-message"></div>
            <div class="alert alert-success hide" id="sent-message"></div>

            <div class="form-group">
                  <div class="card mt-3">
                     <div class="card-body">
                    <h4>Please Verify Phone number to proceed.</h4>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Phone Number:</label>
                                <input type="text" id="contact" name="contact" value= "{{ old('contact')}}"  class="form-control" placeholder="+639XXXXXXXXXX">
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
                                        document.getElementById("signup").disabled = true;
                                        document.getElementById("signup").setAttribute("type", "hidden");
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
                                    document.getElementById("signup").disabled = false;
                                    document.getElementById("signup").setAttribute("type", "submit");
                                    document.getElementById("otp-codes").classList.remove("d-block");
                                    document.getElementById("otp-button").style.visibility = 'hidden';
                                    document.getElementById("otp-button").disabled = true;

                                }).catch(function (error) {
                                    document.getElementById("error-message").innerHTML = error.message;
                                    document.getElementById("error-message").classList.add("d-block");
                                    document.getElementById("sent-message").classList.remove("d-block");
                                    document.getElementById("signup").disabled = true;
                                    document.getElementById("signup").setAttribute("type", "hidden");

                                });
                            }
                        </script>
                </div>

                <div class="form-group">
                    <label for="address">Address: </label>
                    <input type="text" name="address" id="address" value= "{{ old('address')}}" class="form-control">
                </div>


                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" value="{{ old('email')}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>


                <div class="form-group ">
                    <!-- <label for="password">Password: </label>
                    <input type="file" name="img" id="img" class="form-control"> -->
                    {!!Form::label('Select image to upload:')!!}
                    {!! Form::file('img',['class' => 'form-control']); !!}
                    @if($errors->has('img'))
                    <a>{{ $errors->first('img') }}</a>
                    @endif
                </div>

                    <input type="hidden" disabled ="true" id="signup" name="signup" value="Sign Up" class="btn btn-primary">
             </form>

    </div>

@endsection










