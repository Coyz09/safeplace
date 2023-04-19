@extends('layouts.base')
@include('partials.sidebar2')

@section('body')


<div class="container-xl" style = "margin-left: 120px;">
<div id="layoutSidenav_content">
<!-- <div id="hight-chart"></div> -->
<main>
                    <div class="container-fluid px-4">
                        <!-- <h1 class="mt-4">Admin Dashboard</h1> -->
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol> -->
                        <div class="row">
                        <div class="col">
                            <h2 class="text-info">Dashboard /
                                <small class="text-muted">Barangay Dashboard</small>
                            </h2>
                        </div>
                    </div>
<div class="row">
                <div class="col-md-6">
								<div class="card bg-success text-white mb-4">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center" style="padding:70px; float:center; width:70px;">
                                                 <i class="fa-solid fa-file-lines fa-4x"></i>
												</div>
											</div>
											<div class="col-7  align-items-center">

                                                <div class="numbers">
													<p class="card-category" style="font-weight:bold; font-size:22px;" >Total Number of Reports: </p>
													<h3 class="card-title" style="font-weight:bold; font-size:30px;"  >{{$totalreports}}</h3>
												</div>    
                                                
												<div class="numbers">
													<p class="card-category" style="font-weight:bold; font-size:22px;" >Total Reports Today:</p>
													<h3 class="card-title" style="font-weight:bold; font-size:30px;" >{{$totaldailyreports}}</h3>
												</div>    
                                                
											</div>                     
										</div>
									</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('barangay_user.index') }}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
								</div>
							</div>

                            <div class="col-md-6">
								<div class="card bg-info text-white mb-4">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
                                            <div class="icon-big text-center" style="padding:70px; float:center; width:70px;">
                                                <!-- <i class="fa-solid fa-money-check fa-3x"></i> -->
                                                <!-- <i class="fa-solid fa-file-lines fa-4x"></i> -->
                                                <!-- <i class="fa-solid fa-rectangle-list fa-4x"></i> -->
                                                <i class="fa-solid fa-calendar-days fa-4x"></i>

												</div>
											</div>
											<div class="col-7 align-items-center">
                                                <div class="numbers">
													<p class="card-category" style="font-weight:bold; font-size:21.25px;">Total Weekly Reports:</p>
													<h3 class="card-title" style="font-weight:bold; font-size:31px;" >{{$totalweeklyreports}}</h3>
												</div>    

                                                <div class="numbers">
													<p class="card-category" style="font-weight:bold; font-size:21.25px;">Total Monthly Reports:</p>
													<h3 class="card-title" style="font-weight:bold; font-size:31px;" >{{$totalmonthlyreports}}</h3>
												</div>   

											</div>                     
										</div>
									</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('barangay_user.index') }}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
								</div>
							</div>
                         

                                </div>
                            


     </div>   
<div class="container" id="container1" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
<!-- <div class="container" id="container"></div> -->
<br />
<div class="container" id="container2" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
<br />
<!-- <div class="container" id="container3" style="min-width: 400px; height: 400px; margin: 0 auto"> </div> -->
</div>

</div>

<script type="text/javascript">
   

    var reportss2023 =  <?php echo json_encode($totalallreports) ?>;
    var responded =  <?php echo json_encode($totalresponded ) ?>;
    var pending =  <?php echo json_encode($totalpending) ?>;
    var transferred=  <?php echo json_encode($totaltransferred) ?>;
    var months =  <?php echo json_encode($months) ?>;

    // var result = Object.values(transferred);
    // var results = Object.values(responded);
    // delete results[0];
    // results.unshift("")
    // array_unshift($results,"");

    // unset($results[0]);
   
    //   console.log(transferred);

    //   console.log(responded);
    //   console.log(result);
    //   console.log(results);


    const data = {
    2023: reportss2023,
    }
   
    const chart =  Highcharts.chart('container1', {
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
        // inverted: true,
            type: 'spline'
        },
        
        title: {
            text: '2023 Reports',
            style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '20px'
                },
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            title: {
             text: 'Month',
             style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '15px'
                },
            },

            categories: ['Month','Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            labels:{
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                },
            },
            // categories: months
            // // type: 'category' 

            // categories: months.map(date => {
            // return Highcharts.dateFormat('%b', new Date(date).getTime());
            // }),  
            
        },
       
        yAxis: {
          
            title: {
                text: 'Number of Reports',
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '15px'
                },
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
                    alert('Month: ' + this.category + ', Number of Reports: ' + this.y);
                }
                }
            }
            }
        },

        series: [{
            // type: 'column',
            name: 'Total Number of Reports',
            data: reportss2023, 

        } ,
        {
            // type: 'column',
            name: 'Responded',
            data: responded, 
            color: '#00FF00'

        },
        {
            // type: 'column',
            name: 'Pending',
            data: pending, 
            color:'tomato'

        },
        {
            // type: 'column',
            name: 'Transferred',
            data: transferred, 
            color: '#EE82EE'

        }
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


    var commoncrime =  <?php echo json_encode($commoncrime) ?>;
    var commoncrimetotal =  <?php echo json_encode($commoncrimetotal) ?>;
    var commoncrimeyearly =  <?php echo json_encode($commoncrimeyearly) ?>;
    var commoncrimetotalyearly =  <?php echo json_encode($commoncrimetotalyearly) ?>;

    const charts =  Highcharts.chart('container2', {
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
        // inverted: true,
            type: 'bar'
        },
        
        title: {
            text: 'Top Most Occured Crimes/Incidents for the Current Month and Year',
            style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '20px'
                },
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            // title: {
            //  text: 'Month'
            // },
            // title: {
            //     text: 'Types of Crime Reported',
            //     style: {
            //     color: 'black',
            //     fontWeight: 'bold',
            //     fontSize: '15px'
            //     },
            // },
            labels:{
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                },
            },
            categories: commoncrimeyearly
        },
       
        yAxis: {
          
            title: {
                text: 'Number of Reports',
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '15px'
                },
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
                    alert('Crime: ' + this.category + ', Number of Reports: ' + this.y);
                }
                }
            }
            }
        },

        series: [{
            // type: 'column',
            name: 'Current Month',
            data: commoncrimetotal, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearly, 
            color:'tomato'
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
        // inverted: true,
            type: 'bar'
        },
        
        title: {
            text: 'Types of Crime Reported for the Current Year'
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            // title: {
            //  text: 'Month'
            // },
            // title: {
            //     text: 'Types of Crime Reported'
            // },
            categories: commoncrimeyearly       
        },
       
        yAxis: {
          
            title: {
                text: 'Reports'
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
                    alert('Crime: ' + this.category + ', Number of Reports: ' + this.y);
                }
                }
            }
            }
        },

        series: [{
            // type: 'column',
            name: 'Report Number',
            data: commoncrimetotalyearly, 

        } ,
        // {
        //     // type: 'column',
        //     name: 'Responded',
        //     data: responded, 

        // },
        // {
        //     // type: 'column',
        //     name: 'Pending',
        //     data: pending, 

        // },
        // {
        //     // type: 'column',
        //     name: 'Transferred',
        //     data: transferred, 

        // }
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

// $( document ).ready(function() {
//         document.getElementById('year').addEventListener('change', function(e) {
//         if (e.target.value) {
//             // chart.series[0].setData(data[e.target.value]);
//             chart.series[0].update({
//                 data: data[e.target.value]
//             }, false, false, false);
//             chart.redraw();
//         } 
//         else {
//             chart.series[0].setData(data.general);
//             chart.redraw();
//         }

        
//         });
//     });
 

</script>

@endsection


