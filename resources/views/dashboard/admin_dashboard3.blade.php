@extends('layouts.base')
@include('partials.sidebar')

@section('body')
<div class="container-xl" style = "margin-left: 120px;">
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                     
                    <a href="{{url()->previous()}}">
                    <button class="btn btn-danger"><-Back to Main Dashboard</button>
                    </a>
                    <br /> 
                        <div class="row">
                        <br /> 
                       
                    </div>
                       
        

    <br /> 
    <h2 class="text-info">Top Most Occured Crimes/Incidents per Police Substation:</h2> 
    <br /> 

    <div class="container" id="container1" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container2" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container3" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container4" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container5" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container6" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>


</div>

<script>
    
    var commoncrimetotal1 =  <?php echo json_encode($commoncrimetotal1) ?>;
    var commoncrimeyearly1 =  <?php echo json_encode($commoncrimeyearly1) ?>;
    var commoncrimetotalyearly1 =  <?php echo json_encode($commoncrimetotalyearly1) ?>;

   const chart1 =  Highcharts.chart('container1', {
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
            text: 'Top Most Occured Crimes/Incidents in Barangay Police Substation 1 for the Current Month and Year',
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
            labels:{
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                },
            },
            categories: commoncrimeyearly1
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
            data: commoncrimetotal1, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearly1, 
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


  var commoncrimetotal2=  <?php echo json_encode($commoncrimetotal2) ?>;
  var commoncrimeyearly2=  <?php echo json_encode($commoncrimeyearly2) ?>;
  var commoncrimetotalyearly2 =  <?php echo json_encode($commoncrimetotalyearly2) ?>;

   const chart2 =  Highcharts.chart('container2', {
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
            text: 'Top Most Occured Crimes/Incidents in Police Substation 2 for the Current Month and Year',
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
            labels:{
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                },
            },
            categories: commoncrimeyearly2
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
            data: commoncrimetotal2, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearly2, 
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
    
    
    
  var commoncrimetotal3 =  <?php echo json_encode($commoncrimetotal3 ) ?>;
  var commoncrimeyearly3  =  <?php echo json_encode($commoncrimeyearly3 ) ?>;
  var commoncrimetotalyearly3  =  <?php echo json_encode($commoncrimetotalyearly3) ?>;

   const chart3 =  Highcharts.chart('container3', {
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
            text: 'Top Most Occured Crimes/Incidents in Police Substation 3 for the Current Month and Year',
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
            labels:{
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                },
            },
            categories: commoncrimeyearly3
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
            data: commoncrimetotal3, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearly3, 
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

  var commoncrimetotal6  =  <?php echo json_encode($commoncrimetotal6 ) ?>;
  var commoncrimeyearly6  =  <?php echo json_encode($commoncrimeyearly6 ) ?>;
  var commoncrimetotalyearly6 =  <?php echo json_encode($commoncrimetotalyearly6) ?>;

   const chart4 =  Highcharts.chart('container4', {
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
            text: 'Top Most Occured Crimes/Incidents in Police Substation 6 for the Current Month and Year',
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
            labels:{
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                },
            },
            categories: commoncrimeyearly6
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
            data: commoncrimetotal6, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearly6, 
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
    

  var commoncrimetotal7 =  <?php echo json_encode($commoncrimetotal7) ?>;
  var commoncrimeyearly7 =  <?php echo json_encode($commoncrimeyearly7 ) ?>;
  var commoncrimetotalyearly7  =  <?php echo json_encode($commoncrimetotalyearly7 ) ?>;

   const chart5 =  Highcharts.chart('container5', {
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
            text: 'Top Most Occured Crimes/Incidents in Police Substation 7 for the Current Month and Year',
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
            labels:{
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                },
            },
            categories: commoncrimeyearly7
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
            data: commoncrimetotal7, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearly7, 
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

  var commoncrimetotal8=  <?php echo json_encode($commoncrimetotal8) ?>;
  var commoncrimeyearly8=  <?php echo json_encode($commoncrimeyearly8 ) ?>;
  var commoncrimetotalyearly8  =  <?php echo json_encode($commoncrimetotalyearly8) ?>;

   const chart6 =  Highcharts.chart('container6', {
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
            text: 'Top Most Occured Crimes/Incidents in Police Substation 8 for the Current Month and Year',
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
            labels:{
                style: {
                color: 'black',
                fontWeight: 'bold',
                fontSize: '13px'
                },
            },
            categories: commoncrimeyearly8
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
            data: commoncrimetotal8, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearly8, 
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
</script>
@endsection


