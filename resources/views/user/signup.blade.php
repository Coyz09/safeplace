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
</style>

<div class="row" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="col-md-4 col-md-offset-4">
    <h2>Create new Account</h2>
    <p>Already have an account? <a href="{{ route('user.signin') }}"  >Login Here</a></p>




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

        <div class="form-group">
            <label for="address">Address: </label>
            <input type="text" name="address" id="address" value= "{{ old('address')}}" class="form-control">
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" >Proceed</button>

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

                        <h5 class="modal-title">Enter Login Credentials:</h5>
                        <!-- <h4>Please Verify Phone number to proceed.</h4> -->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="form-group">
                    <div class="card">
                    <div class="card-body">
                        <label for="email">Email: </label>
                        <input type="text" name="email" id="email" value="{{ old('email')}}" class="form-control">
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="card">
                    <div class="card-body">
                        <label for="password">Password: </label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    </div>
                    </div>


                    <div class="form-group ">
                    <div class="card">
                    <div class="card-body">
                        {!!Form::label('Select image to upload:')!!}
                        {!! Form::file('img',['class' => 'form-control']); !!}
                        @if($errors->has('img'))
                        <a>{{ $errors->first('img') }}</a>
                        @endif
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
                    <a href="{{url()->previous()}}" class="btn btn-default" role="button">Back</a>
        </div>

@endsection










