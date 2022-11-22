<html>
    <head>
        <title>Phone number authentication</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
            .hide {
                display: none;
            }
        </style>
    </head>
<body>  
    <div class="container">
        <h1 class="text-center m-3">Phone number authentication</h1>
        <div class="alert alert-danger hide" id="error-message"></div>
        <div class="alert alert-success hide" id="sent-message"></div>
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="phone-number" class="form-label">Phone Number:</label>
                        <input type="text" id="phone-number" class="form-control" placeholder="+639XXXXXXXXXX">
                    </div>
                    <div id="recaptcha-container"></div>
                    <button type="button" class="btn btn-info" onclick="otpSend();">Send OTP</button>
                </form>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="otp-code" class="form-label">OTP code:</label>
                        <input type="text" id="otp-code" class="form-control" placeholder="Enter OTP Code">
                    </div>
                    <button type="button" class="btn btn-info" onclick="otpVerify();">Verify OTP</button>
                </form>
            </div>
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
            var phoneNumber = document.getElementById('phone-number').value;
            const appVerifier = window.recaptchaVerifier;
            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                .then((confirmationResult) => {
                    // SMS sent. Prompt user to type the code from the message, then sign the
                    // user in with confirmationResult.confirm(code).
                    window.confirmationResult = confirmationResult;

                    document.getElementById("sent-message").innerHTML = "Message sent succesfully.";
                    document.getElementById("sent-message").classList.add("d-block");
                }).catch((error) => {
                    document.getElementById("error-message").innerHTML = error.message;
                    document.getElementById("error-message").classList.add("d-block");
                });
        }

        function otpVerify() {
            var code = document.getElementById('otp-code').value;
            confirmationResult.confirm(code).then(function (result) {
                // User signed in successfully.
                var user = result.user;

                document.getElementById("sent-message").innerHTML = "You are succesfully logged in.";
                document.getElementById("sent-message").classList.add("d-block");
      
            }).catch(function (error) {
                document.getElementById("error-message").innerHTML = error.message;
                document.getElementById("error-message").classList.add("d-block");
            });
        }
    </script>
</body>
</html>