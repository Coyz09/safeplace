@extends('layouts.base')
@include('partials.sidebar')

@section('body')
<div class="container">
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <!-- <h1 class="mt-4">Admin Dashboard</h1> -->
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol> -->
                        <div class="row">
                        <div class="col">
                            <h2 class="text-info">Dashboard /
                                <small class="text-muted">Admin Dashboard</small>
                            </h2>
                        </div>
                    </div>
                        <div class="row">
                            
                       

                            <div class="col-md-4">
								<div class="card bg-success text-white mb-4">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="fa-solid fa-user-check fa-2x"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
                                                
												<div class="numbers">
													<p class="card-category">Verified Users</p>
													<h4 class="card-title">{{$verifiedcount}}</h4>
												</div>                    
											</div>                     
										</div>
									</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('verifieduser.index') }}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
								</div>
							</div>

                            <div class="col-md-4">
								<div class="card bg-info text-white mb-4">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="fa-solid fa-user-lock fa-2x"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
                                                
												<div class="numbers">
													<p class="card-category">Unverified Users</p>
													<h4 class="card-title">{{$unverifiedcount}}</h4>
												</div>                    
											</div>                     
										</div>
									</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('unverifieduser.index') }}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
								</div>
							</div>


                            <div class="col-md-4">
								<div class="card bg-warning text-black mb-4">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="fa-solid fa-landmark-flag fa-2x"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
                                                
												<div class="numbers">
													<p class="card-category">Barangays</p>
													<h4 class="card-title">{{$barangaycount}}</h4>
												</div>                    
											</div>                     
										</div>
									</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="{{ route('barangay.index') }}">View Details</a>
                                        <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                    </div>
								</div>
							</div>
                            </div>
                    <div class="row">
                        
                          <div class="col-xl-5 col-md-6">
                                <div class="card bg-danger text-white mb-4">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="fa-solid fa-hospital fa-2x"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
                                                
												<div class="numbers">
													<p class="card-category">Hospitals</p>
													<h4 class="card-title">{{$hospitalcount}}</h4>
												</div>                    
											</div>                     
										</div>
									</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('hospital.index') }}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
								</div>
							</div>

                        
                        <div class="col-xl-5 col-md-">
                                <div class="card bg-primary text-white mb-4">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="fa-sharp fa-solid fa-building-columns  fa-2x"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
                                                
												<div class="numbers">
													<p class="card-category">Police Substations</p>
													<h4 class="card-title">{{$policecount}}</h4>
												</div>                    
											</div>                     
										</div>
									</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('policestation.index') }}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
								</div>
							</div>
                        </div>
        

   <h2>Locations: </h2>
    <div class="fullwidth-sidebar-container">
    <div class="sidebar top-sidebar">
        <div id="map-canvas" style="height: 425px; width: 100%; position: relative; overflow: hidden;">
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
{{-- <script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=myMap"></script> --}}
<script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&region=GB'></script>
<script defer>
	function initialize() {
		var mapOptions = {
			zoom: 12.60,
			minZoom: 6,
			maxZoom: 17,
			zoomControl:true,
			zoomControlOptions: {
  				style:google.maps.ZoomControlStyle.DEFAULT
			},
			center: new google.maps.LatLng({{ $latitude }}, {{ $longitude }}),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: true,
			panControl:false,
			mapTypeControl:false,
			scaleControl:false,
			overviewMapControl:false,
			rotateControl:false
	  	}
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var hospitalimage = new google.maps.MarkerImage("Images/hospitalpin.png", null, null, null, new google.maps.Size(49,52));
        var barangayimage = new google.maps.MarkerImage("Images/barangaypin.png", null, null, null, new google.maps.Size(49,52));
        var policeimage = new google.maps.MarkerImage("Images/policepin.png", null, null, null, new google.maps.Size(49,52));
        

        var hospitals = @json($mapHospitals);
        var barangays = @json($mapBarangays);
        var police = @json($mapPolice);

        for(hospital in hospitals)
        {
            hospital = hospitals[hospital];
            if(hospital.latitude && hospital.longitude)
            {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(hospital.latitude, hospital.longitude),
                    icon:hospitalimage,
                    map: map,
                    title: hospital.hospital_name
                });
                var infowindow = new google.maps.InfoWindow();
                google.maps.event.addListener(marker, 'click', (function (marker, hospital) {
                    return function () {
                        infowindow.setContent(generateHospitalContents(hospital))
                        infowindow.open(map, marker);
                    }
                })(marker, hospital));
            }
        }

        for(barangay in barangays)
        {
            barangay = barangays[barangay];
            if(barangay.latitude && barangay.longitude)
            {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(barangay.latitude, barangay.longitude),
                    icon:barangayimage,
                    map: map,
                    title: barangay.barangay_name
                });
                var infowindow = new google.maps.InfoWindow();
                google.maps.event.addListener(marker, 'click', (function (marker, barangay) {
                    return function () {
                        infowindow.setContent(generateBarangayContents(barangay))
                        infowindow.open(map, marker);
                    }
                })(marker, barangay));
            }
        }

        for(polic in police)
        {
            polic = police[polic];
            if(polic.latitude && polic.longitude)
            {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(polic.latitude, polic.longitude),
                    icon:policeimage,
                    map: map,
                    title: polic.policestation_name
                });
                var infowindow = new google.maps.InfoWindow();
                google.maps.event.addListener(marker, 'click', (function (marker, polic) {
                    return function () {
                        infowindow.setContent(generatePoliceContents(polic))
                        infowindow.open(map, marker);
                    }
                })(marker, polic));
            }
        }
	}
	google.maps.event.addDomListener(window, 'load', initialize);

    function generateHospitalContents(hospital)
    {
        var contents = `
            <div class="gd-bubble" style="">
                <div class="gd-bubble-inside">
                    <div class="geodir-bubble_desc">
                    <div class="geodir-bubble_image">
                        <div class="geodir-post-slider">
                            <div class="geodir-image-container geodir-image-sizes-medium_large ">
                                <div id="geodir_images_5de53f2a45254_189" class="geodir-image-wrapper" data-controlnav="1">
                                    <ul class="geodir-post-image geodir-images clearfix">
                                        <li>
                                            <div class="geodir-post-title">
                                                <h4 class="geodir-entry-title">
                                                    <a href="{{ route('hospital', '') }}/`+hospital.id+`" title="View: `+hospital.hospital_name+`">`+hospital.hospital_name+`</a>
                                                </h4>
                                            </div>
                                            <a href="{{ route('hospital', '') }}/`+hospital.id+`"><img src="`+hospital.img+`" alt="`+hospital.hospital_name+`" class="align size-medium_large" width="400" height="130"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="geodir-bubble-meta-side">
                    <div class="geodir-output-location">
                    <div class="geodir-output-location geodir-output-location-mapbubble">
                        <div class="geodir_post_meta  geodir-field-post_title"><span class="geodir_post_meta_icon geodir-i-text">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Place Title: </span></span>`+hospital.hospital_name+`</div>
                        <div class="geodir_post_meta  geodir-field-address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <span class="geodir_post_meta_icon geodir-i-address"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Address: </span></span><span itemprop="streetAddress">`+hospital.hospital_location+`</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            </div>`;

    return contents;

    }


    function generateBarangayContents(barangay)
    {
        var contents = `
            <div class="gd-bubble" style="">
                <div class="gd-bubble-inside">
                    <div class="geodir-bubble_desc">
                    <div class="geodir-bubble_image">
                        <div class="geodir-post-slider">
                            <div class="geodir-image-container geodir-image-sizes-medium_large ">
                                <div id="geodir_images_5de53f2a45254_189" class="geodir-image-wrapper" data-controlnav="1">
                                    <ul class="geodir-post-image geodir-images clearfix">
                                        <li>
                                            <div class="geodir-post-title">
                                                <h4 class="geodir-entry-title">
                                                    <a href="{{ route('barangay', '') }}/`+barangay.id+`" title="View: `+barangay.barangay_name+`">`+barangay.barangay_name+`</a>
                                                </h4>
                                            </div>
                                            <a href="{{ route('barangay', '') }}/`+barangay.id+`"><img src="`+barangay.img+`" alt="`+barangay.barangay_name+`" class="align size-medium_large" width="400" height="130"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="geodir-bubble-meta-side">
                    <div class="geodir-output-location">
                    <div class="geodir-output-location geodir-output-location-mapbubble">
                        <div class="geodir_post_meta  geodir-field-post_title"><span class="geodir_post_meta_icon geodir-i-text">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Place Title: </span></span>`+barangay.barangay_name+`</div>
                        <div class="geodir_post_meta  geodir-field-address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <span class="geodir_post_meta_icon geodir-i-address"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Address: </span></span><span itemprop="streetAddress">`+barangay.barangay_location+`</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            </div>`;

    return contents;

    }

    function generatePoliceContents(polic)
    {
        var contents = `
            <div class="gd-bubble" style="">
                <div class="gd-bubble-inside">
                    <div class="geodir-bubble_desc">
                    <div class="geodir-bubble_image">
                        <div class="geodir-post-slider">
                            <div class="geodir-image-container geodir-image-sizes-medium_large ">
                                <div id="geodir_images_5de53f2a45254_189" class="geodir-image-wrapper" data-controlnav="1">
                                    <ul class="geodir-post-image geodir-images clearfix">
                                        <li>
                                            <div class="geodir-post-title">
                                                <h4 class="geodir-entry-title">
                                                    <a href="{{ route('police', '') }}/`+polic.id+`" title="View: `+polic.policestation_name+`">`+polic.policestation_name+`</a>
                                                </h4>
                                            </div>
                                            <a href="{{ route('police', '') }}/`+polic.id+`"><img src="`+polic.img+`" alt="`+polic.policestation_name+`" class="align size-medium_large" width="400" height="130"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="geodir-bubble-meta-side">
                    <div class="geodir-output-location">
                    <div class="geodir-output-location geodir-output-location-mapbubble">
                        <div class="geodir_post_meta  geodir-field-post_title"><span class="geodir_post_meta_icon geodir-i-text">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Place Title: </span></span>`+polic.policestation_name+`</div>
                        <div class="geodir_post_meta  geodir-field-address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <span class="geodir_post_meta_icon geodir-i-address"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Address: </span></span><span itemprop="streetAddress">`+polic.policestation_location+`</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            </div>`;

    return contents;

    }
</script>

@endsection