@extends('layouts.base')
@include('partials.sidebar')

@section('body')
<div class="container-xl" style = "margin-left: 120px;">
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
                        
                          <div class="col-xl-5 col-md-6" style="left:80px;">
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

                        
                        <div class="col-xl-5 col-md-" style="left:80px;">
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
    <br /> 
    <h2>Statistics: </h2> 
    <br /> 
    <div class="container" id="container6" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br />
    <div class="container" id="container1" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container2" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container7" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br />
    <div class="container" id="container5" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br />
    <div class="container" id="container3" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container4" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
   

   

</div>

<script>
      
    var barangaypending=  <?php echo json_encode($numberofbarangaypending) ?>;
    var barangaypendingyearly =  <?php echo json_encode($numberofbarangaypendingyearly) ?>;
    var barangaypendingmonthly =  <?php echo json_encode($numberofbarangaypendingmonthly) ?>;

    var barangayresponded=  <?php echo json_encode($numberofbarangayresponded) ?>;
    var barangayrespondedyearly =  <?php echo json_encode($numberofbarangayrespondedyearly) ?>;
    var barangayrespondedmonthly =  <?php echo json_encode($numberofbarangayrespondedmonthly) ?>;

    const chart =  Highcharts.chart('container2', {
        // chart: {
        //         renderTo: 'container',
        //         zoomType: 'x',
        //         spacingRight: 20
        //     },

        chart: {
            options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        }, 
            type: 'bar'
        },
        
        title: {
            text: 'Top Most Barangay with Pending Reports for the Current Month and Year',
            style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '20px'
                }
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            // title: {
            //  text: 'Month'
            // },
            // title: {
            //     text: 'Barangays',
            //     style: {
            //     color: 'black',
            //     fontWeight: 'bold',
            //     fontSize: '15px'
            //     }
            // },
            labels:{
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                }
            },
            
            categories: barangaypending
        },
       
        yAxis: {
          
            title: {
                text: 'Number of Reports',
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '15px'
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        tooltip: {
                shared: true
            },
        plotOptions: {
            series: {
                allowPointSelect: true
            },
            series: {
            cursor: 'pointer',
            point: {
                events: {
                click: function() {
                    alert('Barangay: ' + this.category + ', Number of Pending Reports: ' + this.y);
                }
                }
            }
            }
        },

        series: [
        {
            // type: 'column',
            name: 'Number of Pending Reports(Current Month)',
            data: barangaypendingmonthly, 
            color: 'orange'

        } ,
        {
            // type: 'column',
            name: 'Number of Pending Reports(Current Year)',
            data: barangaypendingyearly, 
            color: 'tomato'

        } ,

        // {
        //     // type: 'column',
        //     name: 'Current Year',
        //     data: commoncrimetotalyearly, 

        // } ,
        ],
        
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
            
            
    });

    const charts =  Highcharts.chart('container1', {
        // chart: {
        //         renderTo: 'container',
        //         zoomType: 'x',
        //         spacingRight: 20
        //     },

        chart: {
            options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        }, 
            type: 'bar'
        },
        
        title: {
            text: 'Top Most Barangay with Responded Reports for the Current Month and Year',
            style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '20px'
                }
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            // title: {
            //  text: 'Month'
            // },
            // title: {
            //     text: 'Barangays',
            //     style: {
            //     color: 'black',
            //     fontWeight: 'bold',
            //     fontSize: '15px'
            //     }
                
            // },
            labels: {
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                }
            },
            categories: barangayresponded,
            
            
            
        },
       
        yAxis: {
          
            title: {
                text: 'Number of Reports',
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '15px'
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        tooltip: {
                shared: true
            },
        plotOptions: {
            series: {
                allowPointSelect: true
            },
            series: {
            cursor: 'pointer',
            point: {
                events: {
                click: function() {
                    alert('Barangay: ' + this.category + ', Number of Responded Reports: ' + this.y);
                }
                }
            }
            }
        },

        series: [
        {
            // type: 'column',
            name: 'Number of Responded Reports(Current Month)',
            data: barangayrespondedmonthly, 
            color: 'lime'
     

        } ,
        {
            // type: 'column',
            name: 'Number of Responded Reports(Current Year)',
            data: barangayrespondedyearly, 
            color: 'green'

        } ,

        // {
        //     // type: 'column',
        //     name: 'Current Year',
        //     data: commoncrimetotalyearly, 

        // } ,
        ],
        
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
            
            
    });

    var policepending=  <?php echo json_encode($numberofpolicepending) ?>;
    var policependingyearly =  <?php echo json_encode($numberofpolicependingyearly) ?>;
    var policependingmonthly =  <?php echo json_encode($numberofpolicependingmonthly) ?>;

    var policeresponded=  <?php echo json_encode($numberofpoliceresponded) ?>;
    var policerespondedyearly =  <?php echo json_encode($numberofpolicerespondedyearly) ?>;
    var policerespondedmonthly =  <?php echo json_encode($numberofpolicerespondedmonthly) ?>;

    const chart2 =  Highcharts.chart('container4', {
        // chart: {
        //         renderTo: 'container',
        //         zoomType: 'x',
        //         spacingRight: 20
        //     },

        chart: {
            options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        }, 
            type: 'bar'
        },
        
        title: {
            text: 'Top Most Police Substation with Pending Reports for the Current Month and Year',
            style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '20px'
                }
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            // title: {
            //  text: 'Month'
            // },
            // title: {
            //     text: 'Police Substations',
            //     style: {
            //     color: 'black',
            //     fontWeight: 'bold',
            //     fontSize: '15px'
            //     }
            // },
            labels:{
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                }
            },
            
            categories: policepending
        },
       
        yAxis: {
          
            title: {
                text: 'Number of Reports',
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '15px'
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        tooltip: {
                shared: true
            },
        plotOptions: {
            series: {
                allowPointSelect: true
            },
            series: {
            cursor: 'pointer',
            point: {
                events: {
                click: function() {
                    alert('Police Substation: ' + this.category + ', Number of Pending Reports: ' + this.y);
                }
                }
            }
            }
        },

        series: [
        {
            // type: 'column',
            name: 'Number of Pending Reports(Current Month)',
            data: policependingmonthly, 
            color: 'orange'

        } ,
        {
            // type: 'column',
            name: 'Number of Pending Reports(Current Year)',
            data: policependingyearly, 
            color: 'tomato'

        } ,

        // {
        //     // type: 'column',
        //     name: 'Current Year',
        //     data: commoncrimetotalyearly, 

        // } ,
        ],
        
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
            
            
    });

    const charts2 =  Highcharts.chart('container3', {
        // chart: {
        //         renderTo: 'container',
        //         zoomType: 'x',
        //         spacingRight: 20
        //     },

        chart: {
            options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        }, 
            type: 'bar'
        },
        
        title: {
            text: 'Top Most Police Substation with Responded Reports for the Current Month and Year',
            style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '20px'
                }
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            // title: {
            //  text: 'Month'
            // },
            // title: {
            //     text: 'Police Substations',
            //     style: {
            //     color: 'black',
            //     fontWeight: 'bold',
            //     fontSize: '15px'
            //     }
                
            // },
            labels: {
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                }
            },
            categories: policeresponded,
            
            
            
        },
       
        yAxis: {
          
            title: {
                text: 'Number of Reports',
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '15px'
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        tooltip: {
                shared: true
            },
        plotOptions: {
            series: {
                allowPointSelect: true
            },
            series: {
            cursor: 'pointer',
            point: {
                events: {
                click: function() {
                    alert('Police Substation: ' + this.category + ', Number of Responded Reports: ' + this.y);
                }
                }
            }
            }
        },

        series: [
        {
            // type: 'column',
            name: 'Number of Responded Reports(Current Month)',
            data: policerespondedmonthly, 
            color: 'lime'
     

        } ,
        {
            // type: 'column',
            name: 'Number of Responded Reports(Current Year)',
            data: policerespondedyearly, 
            color: 'green'

        } ,

        // {
        //     // type: 'column',
        //     name: 'Current Year',
        //     data: commoncrimetotalyearly, 

        // } ,
        ],
        
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
            
            
    });

    var policereport2023=  <?php echo json_encode($policereport2023) ?>;
    var policereportmonthly2023 =  <?php echo json_encode($totalofpolicereportmonthly2023) ?>;
    var policereportyearly2023 =  <?php echo json_encode($totalofpolicereportyearly2023) ?>;

    var barangayreport2023=  <?php echo json_encode($barangayreport2023) ?>;
    var barangayreportmonthly2023 =  <?php echo json_encode($totalofbarangayreportmonthly2023) ?>;
    var barangayreportyearly2023 =  <?php echo json_encode($totalofbarangayreportyearly2023) ?>;

    const chart3 =  Highcharts.chart('container5', {
        // chart: {
        //         renderTo: 'container',
        //         zoomType: 'x',
        //         spacingRight: 20
        //     },

        chart: {
            options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        }, 
            type: 'bar'
        },
        
        title: {
            text: 'Total Number of Reports per Police Substation for the Current Month and Year',
            style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '20px'
                }
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            // title: {
            //  text: 'Month'
            // },
            // title: {
            //     text: 'Police Substations',
            //     style: {
            //     color: 'black',
            //     fontWeight: 'bold',
            //     fontSize: '15px'
            //     }
            // },
            labels:{
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                }
            },
            
            categories: policereport2023
        },
       
        yAxis: {
          
            title: {
                text: 'Number of Reports',
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '15px'
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        tooltip: {
                shared: true
            },
        plotOptions: {
            series: {
                allowPointSelect: true
            },
            series: {
            cursor: 'pointer',
            point: {
                events: {
                click: function() {
                    alert('Police Substation: ' + this.category + ', Total number of Reports: ' + this.y);
                }
                }
            }
            }
        },

        series: [  
            {
            // type: 'column',
            name: 'Total Number of Reports per Police Substation(Current Month)',
            data: policereportmonthly2023, 
            color: 'cyan'

        } ,
        {
            // type: 'column',
            name: 'Total Number of Reports per Police Substation(Current Year)',
            data: policereportyearly2023, 
            color: 'blue'

        } ,

      
       

        // {
        //     // type: 'column',
        //     name: 'Current Year',
        //     data: commoncrimetotalyearly, 

        // } ,
        ],
        
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
            
            
    });

    const chart4 =  Highcharts.chart('container6', {
        // chart: {
        //         renderTo: 'container',
        //         zoomType: 'x',
        //         spacingRight: 20
        //     },

        chart: {
            options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        }, 
            type: 'bar'
        },
        
        title: {
            text: 'Total Number of Reports per Barangay for the Current Month and Year',
            style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '20px'
                }
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            // title: {
            //  text: 'Month'
            // },
            // title: {
            //     text: 'Barangays',
            //     style: {
            //     color: 'black',
            //     fontWeight: 'bold',
            //     fontSize: '15px'
            //     }
            // },
            labels:{
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                }
            },
            
            categories: barangayreport2023
        },
       
        yAxis: {
          
            title: {
                text: 'Number of Reports',
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '15px'
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        tooltip: {
                shared: true
            },
        plotOptions: {
            series: {
                allowPointSelect: true
            },
            series: {
            cursor: 'pointer',
            point: {
                events: {
                click: function() {
                    alert('Barangay: ' + this.category + ', Total number of Reports: ' + this.y);
                }
                }
            }
            }
        },

        series: [ 
        {
            // type: 'column',
            name: 'Total Number of Reports per Barangay(Current Month)',
            data: barangayreportmonthly2023, 
            color: 'cyan'

        } ,
        {
            // type: 'column',
            name: 'Total Number of Reports per Barangay(Current Year)',
            data: barangayreportyearly2023, 
            color: 'blue'

        } ,

       
       

        // {
        //     // type: 'column',
        //     name: 'Current Year',
        //     data: commoncrimetotalyearly, 

        // } ,
        ],
        
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
            
            
    });

    var totalpolicereports =  <?php echo json_encode($totalpolicereports) ?>;
    var allpolicereports =  <?php echo json_encode($allpolicereports) ?>;
    var policereportss2023 =  <?php echo json_encode($policereports2023) ?>;
    var policereportss2022 =  <?php echo json_encode($policereports2022) ?>;
    var policereportss2021 =  <?php echo json_encode($policereports2021) ?>;
    var policereportss2020 =  <?php echo json_encode($policereports2020) ?>;

    const chart5 =  Highcharts.chart('container7', {
        chart: {
            options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        }, 
        // inverted: true,
            type: 'bar'
        },
        
        title: {
            text: 'Total Number of Reports per Police Substation(Yearly)',
            style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '20px'
                }
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            // title: {
            //  text: 'Month'
            // },
            // title: {
            //     text: 'Police Substations',
            //     style: {
            //     color: 'black',
            //     fontWeight: 'bold',
            //     fontSize: '15px'
            //     }
            // },
            labels:{
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                }
            },
            
            categories: allpolicereports
        },
       
        yAxis: {
          
            title: {
                text: 'Number of Reports',
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '15px'
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        tooltip: {
                shared: true
            },
        plotOptions: {
            series: {
                allowPointSelect: true
            },
            series: {
            cursor: 'pointer',
            point: {
                events: {
                click: function() {
                    alert('Police Substation: ' + this.category + ', Total number of Reports: ' + this.y);
                }
                }
            }
            }
        },

        series: [  
            {
            // type: 'funnel',
            name: 'Total Police Reports:',
            data: totalpolicereports, 
            

        } ,
            {
            // type: 'column',
            name: '2023',
            data: policereportss2023, 
            

        } ,
        {
            // type: 'column',
            name: '2022',
            data: policereportss2022, 
         

        } ,
        {
            // type: 'column',
            name: '2021',
            data: policereportss2021, 
           

        } ,
        {
            // type: 'column',
            name: '2020',
            data: policereportss2020, 
       

        } ,
        ],
        
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
            
            
    });

</script>
@endsection

@section('scripts')

<script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&region=GB'>
    
</script>
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