@extends('layouts.frontend')
@section('content')


<div class="staysafe_container">

    <div class="container-1">
        <div class="row">
            <div class="column intro" >
                    <h1 class="intro-title">STAY ALERT AND BE SAFE</h1>
                    <p>Safe Place App is an application with different functional features that help people have a community to be informed about the crimes that occurred in District 2 - Taguig City where users of this application can assess, manage and monitor its risks.</p>
                    <a href="public/apk/safeplace.apk">
                        <button class="dowload_here">DOWLOAD HERE</button>
                    </a>
            </div>
            <div class="column image" >
                <div class="image-container">
                    <img class="imgfront" src="../../Images/frontpage/Frontpages.png">
                </div>
            </div>
        </div>
    </div>

    <div class="container-2">

        <div class="safetitle">
            <h1>SAFE COMMUNITY</h1>
        </div>

        <div class="rowtwo">
            <div class="col-1">
                <div class="img-with-text">
                    <div class="flex-item">
                    <img class="feat-img" src="../../Images/frontpage/feat1.png">
                </div>
                    <p class="features"><strong>Emergency Calls & Filing Reports</strong></p>
                    <p class="caption">These are the powerful functions in this application. Users can easily call whether it is a crime or medical emergency and file a report without any subscription but with a help of internet or mobile data. </p>
            </div>
        </div>
        <div class="col-2">
            <div class="img-with-text">
                <div class="flex-item">
                    <img class="feat-img" src="../../Images/frontpage/feat2.png">
                </div>
                <p class="features"><strong>Community</strong></p>
                <p class="caption">Safe Place App is an application with different functional features that help people have a community to be informed about the crimes that occurred in District 2 - Taguig City where users of this application can assess, manage and monitor its risks.</p>
            </div>
        </div>
        <div class="col-3">
            <div class="img-with-text">
                <div class="flex-item">
                    <img class="feat-img" src="../../Images/frontpage/feat3.png">
                </div>
                <p class="features"><strong>Statistics & Maps</strong></p>
                <p class="caption">Statistics was designed to keep users in track with the crime rates in certain barangay within District 2 - Taguig City for the residents to be informed about the high numbers of crime happened within their barangay. SafePlace App can also show the map locations of the nearest Barangays, Police Sub-stations, and Hospitals from user's area. </p>
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
                    <button class="btn-download">REGISTER</button>
                </a>
            </div>

            <div class="button-wrapper">
                <p class="upper_text_button"><strong>Login Here:</strong></p>
                <a href="{{ route('user.signin') }}">
                    <button class="btn-adminofficial">LOGIN</button>
                </a>
            </div>

        </div>
    </div>


    <div class="container-4">
        <div class="column-steps">
            <div class ="title-how">
                <h1>HOW SAFEPLACE WORK</h1>
            </div>

            <div class="column-phone" >
                <img class="phone-container" src="../../Images/frontpage/phone.png">
            </div>

            <div class ="instruction">
                <h1>The Safe place app is accessible via mobile and personal computing devices. This system will solely monitor the crime rate, police stations, barangay halls, and hospitals in District 2 of Taguig City. Using maps, the application can help to determine the closest hospitals, barangay halls, and police stations. Once users have successfully logged in, they can access nearby sites mentioned. Using "Emergency Swipe" functionalities, such as swipe left (barangay emergency call) and swipe right  (police emergency call), users can also conveniently make emergency calls. Users who have been verified have an option to report occurrences to their community whether anonymously or with their registered credentials. </h1>
            </div>
        </div>
    </div>

</div>

