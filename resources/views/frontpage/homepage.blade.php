@extends('layouts.frontend')
@section('content')

<div class="staysafe_container">

    <div class="container-1">
      <div class="column">

        <div class ="intro">
          <h1>STAY ALERT AND BE SAFE</h1>
        </div>

        <div class ="message">
          <h1>Safe Place App is an application with different functional features that help people have a community to be informed about the crimes that occurred in District 2 - Taguig City where users of this application can assess, manage and monitor its risks. </h1>
        </div>

        <div class ="btndowload">
          <button class="dowload_here">DOWNLOAD HERE</button>
        </div>

      </div>

        <div class="column">
            <img src="../../Images/frontpage/Frontpages.png">
        </div>


    </div>


    <div class="container-2">

        <div class="title_containter2">
        <h1>SAFE COMMUNITY</h1>
        </div>

        <div class="flex-container">

        <div class="img-with-text">
            <div class="flex-item">
            <img src="../../Images/frontpage/feat1.png">
            </div>
            <p class="features"><strong>Emergency Calls & Filing Reports</strong></p>
            <p class="caption">These are the powerful functions in this application. Users can easily call whether it is a crime or medical emergency and file a report without any subscription but with a help of internet or mobile data. </p>
        </div>

        <div class="img-with-text">
            <div class="flex-item">
                <img src="../../Images/frontpage/feat2.png">
            </div>
            <p class="features"><strong>Community</strong></p>
            <p class="caption">Lorem ipsum dolor sit amet. Sit veritatis tenetur rem veritatis aliquam in repellat adipisci aut repellendus officiis sed quod vitae eos molestiae perferendis. </p>
        </div>

        <div class="img-with-text">
            <div class="flex-item">
                <img src="../../Images/frontpage/feat3.png">
            </div>
            <p class="features"><strong>Statistics & Maps</strong></p>
            <p class="caption">Statistics was designed to keep users in track with the crime rates in certain barangay within District 2 - Taguig City for the residents to be informed about the high numbers of crime happened within their barangay. SafePlace App can also show the map locations of the nearest Barangays, Police Sub-stations, and Hospitals from user's area. </p>
        </div>

        </div>

    </div>


    <div class="container-3">

        <div class="round-header">

            <h1 class="protect-title"><strong>MAKE OUR COMMUNITY A SAFER PLACE</strong></h1>
            <h1 class="protect-caption"><strong>HELP US PROTECT THE CITY OF TAGUIG</strong></h1>

            <div class="button-wrapper">
                <p class="upper_text_button"><strong>Create your account here:</strong></p>
                <!-- <button class="btn-download">ABOUT US</button> -->
                <a href="{{ route('user.signup') }}">
                    <button class="btn-download">SIGNUP</button>
                </a>
            </div>

            <div class="button-wrapper">
                <p class="upper_text_button"><strong>Login Here:</strong></p>
                <a href="{{ route('user.signin') }}">
                    <button class="btn-adminofficial">LOGIN</button>
                </a>
            </div>

        </div>

        <div class="column-phone" >
            <img src="../../Images/frontpage/phone.png">
        </div>

        <div class="column-steps">
            <div class ="title-how">
                <h1>HOW SAFEPLACE WORK</h1>
            </div>

            <div class ="message">
                <h1>Lorem ipsum dolor sit amet. Sit veritatis tenetur rem veritatis aliquam in repellat adipisci aut
                repellendus officiis sed quod vitae eos molestiae perferendis. </h1>
            </div>
        </div>

    </div>


</div>

