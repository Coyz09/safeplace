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
    <h2 class="text-info">Top Most Occured Crimes/Incidents per Barangay:</h2> 
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
    <br /> 
    <div class="container" id="container7" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container8" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container9" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container10" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container11" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container12" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>
    <br /> 
    <div class="container" id="container13" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>

</div>

<script>
    
    var commoncrimetotalcentral =  <?php echo json_encode($commoncrimetotalcentral) ?>;
    var commoncrimeyearlycentral =  <?php echo json_encode($commoncrimeyearlycentral) ?>;
    var commoncrimetotalyearlycentral =  <?php echo json_encode($commoncrimetotalyearlycentral) ?>;

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
            text: 'Top Most Occured Crimes/Incidents in Barangay Central Bicutan for the Current Month and Year',
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
            categories: commoncrimeyearlycentral
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
            data: commoncrimetotalcentral, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearlycentral, 
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


  var commoncrimetotalcentralsignal =  <?php echo json_encode($commoncrimetotalcentralsignal) ?>;
  var commoncrimeyearlycentralsignal =  <?php echo json_encode($commoncrimeyearlycentralsignal) ?>;
  var commoncrimetotalyearlycentralsignal =  <?php echo json_encode($commoncrimetotalyearlycentralsignal) ?>;

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
            text: 'Top Most Occured Crimes/Incidents in Barangay Central Signal Village for the Current Month and Year',
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
            categories: commoncrimeyearlycentralsignal
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
            data: commoncrimetotalcentralsignal, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearlycentralsignal, 
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
    
    
    
  var commoncrimetotalfortbonifacio  =  <?php echo json_encode($commoncrimetotalfortbonifacio ) ?>;
  var commoncrimeyearlyfortbonifacio  =  <?php echo json_encode($commoncrimeyearlyfortbonifacio ) ?>;
  var commoncrimetotalyearlyfortbonifacio  =  <?php echo json_encode($commoncrimetotalyearlyfortbonifacio ) ?>;

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
            text: 'Top Most Occured Crimes/Incidents in Barangay Fort Bonifacio for the Current Month and Year',
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
            categories: commoncrimeyearlyfortbonifacio
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
            data: commoncrimetotalfortbonifacio, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearlyfortbonifacio, 
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

  var commoncrimetotalkatuparan  =  <?php echo json_encode($commoncrimetotalkatuparan ) ?>;
  var commoncrimeyearlykatuparan  =  <?php echo json_encode($commoncrimeyearlykatuparan ) ?>;
  var commoncrimetotalyearlykatuparan  =  <?php echo json_encode($commoncrimetotalyearlykatuparan ) ?>;

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
            text: 'Top Most Occured Crimes/Incidents in Barangay Katuparan for the Current Month and Year',
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
            categories: commoncrimeyearlykatuparan
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
            data: commoncrimetotalkatuparan, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearlykatuparan, 
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
    

  var commoncrimetotalmaharlikavillage =  <?php echo json_encode($commoncrimetotalmaharlikavillage ) ?>;
  var commoncrimeyearlymaharlikavillage  =  <?php echo json_encode($commoncrimeyearlymaharlikavillage ) ?>;
  var commoncrimetotalyearlymaharlikavillage  =  <?php echo json_encode($commoncrimetotalyearlymaharlikavillage ) ?>;

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
            text: 'Top Most Occured Crimes/Incidents in Barangay Maharlika Village for the Current Month and Year',
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
            categories: commoncrimeyearlymaharlikavillage
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
            data: commoncrimetotalmaharlikavillage, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearlymaharlikavillage, 
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

  var commoncrimetotalnorthdaanghari =  <?php echo json_encode($commoncrimetotalnorthdaanghari ) ?>;
  var commoncrimeyearlynorthdaanghari =  <?php echo json_encode($commoncrimeyearlynorthdaanghari ) ?>;
  var commoncrimetotalyearlynorthdaanghari  =  <?php echo json_encode($commoncrimetotalyearlynorthdaanghari) ?>;

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
            text: 'Top Most Occured Crimes/Incidents in Barangay NorthDaanghari for the Current Month and Year',
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
            categories: commoncrimeyearlynorthdaanghari
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
            data: commoncrimetotalnorthdaanghari, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearlynorthdaanghari, 
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


  var commoncrimetotalnorthsignal=  <?php echo json_encode($commoncrimetotalnorthsignal ) ?>;
  var commoncrimeyearlynorthsignal =  <?php echo json_encode($commoncrimeyearlynorthsignal ) ?>;
  var commoncrimetotalyearlynorthsignal  =  <?php echo json_encode($commoncrimetotalyearlynorthsignal) ?>;

   const chart7 =  Highcharts.chart('container7', {
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
            text: 'Top Most Occured Crimes/Incidents in Barangay North Signal Village for the Current Month and Year',
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
            categories: commoncrimeyearlynorthsignal
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
            data: commoncrimetotalnorthsignal, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearlynorthsignal, 
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
    
  var commoncrimetotalpinagsama  =  <?php echo json_encode($commoncrimetotalpinagsama ) ?>;
  var commoncrimeyearlypinagsama  =  <?php echo json_encode($commoncrimeyearlypinagsama ) ?>;
  var commoncrimetotalyearlypinagsama  =  <?php echo json_encode($commoncrimetotalyearlypinagsama ) ?>;

   const chart8 =  Highcharts.chart('container8', {
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
            text: 'Top Most Occured Crimes/Incidents in Barangay Pinagsama for the Current Month and Year',
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
            categories: commoncrimeyearlypinagsama
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
            data: commoncrimetotalpinagsama, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearlypinagsama, 
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

  var commoncrimetotalsouthdaanghari   =  <?php echo json_encode($commoncrimetotalsouthdaanghari  ) ?>;
  var commoncrimeyearlysouthdaanghari   =  <?php echo json_encode($commoncrimeyearlysouthdaanghari ) ?>;
  var commoncrimetotalyearlysouthdaanghari  =  <?php echo json_encode($commoncrimetotalyearlysouthdaanghari ) ?>;

   const chart9 =  Highcharts.chart('container9', {
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
            text: 'Top Most Occured Crimes/Incidents in Barangay SouthDaanghari  for the Current Month and Year',
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
            categories: commoncrimeyearlysouthdaanghari 
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
            data: commoncrimetotalsouthdaanghari , 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearlysouthdaanghari , 
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

  var commoncrimetotalsouthsignal   =  <?php echo json_encode($commoncrimetotalsouthsignal  ) ?>;
  var commoncrimeyearlysouthsignal    =  <?php echo json_encode($commoncrimeyearlysouthsignal ) ?>;
  var commoncrimetotalyearlysouthsignal   =  <?php echo json_encode($commoncrimetotalyearlysouthsignal) ?>;

   const chart10 =  Highcharts.chart('container10', {
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
            text: 'Top Most Occured Crimes/Incidents in Barangay South Signal Village for the Current Month and Year',
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
            categories: commoncrimeyearlysouthsignal
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
            data: commoncrimetotalsouthsignal , 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearlysouthsignal , 
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

  var commoncrimetotaltanyag  =  <?php echo json_encode($commoncrimetotaltanyag ) ?>;
  var commoncrimeyearlytanyag   =  <?php echo json_encode($commoncrimeyearlytanyag) ?>;
  var commoncrimetotalyearlytanyag  =  <?php echo json_encode($commoncrimetotalyearlytanyag) ?>;

   const chart11 =  Highcharts.chart('container11', {
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
            text: 'Top Most Occured Crimes/Incidents in Barangay Tanyag  for the Current Month and Year',
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
            categories: commoncrimeyearlytanyag 
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
            data: commoncrimetotaltanyag , 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearlytanyag , 
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


  var commoncrimetotalupper   =  <?php echo json_encode($commoncrimetotalupper) ?>;
  var commoncrimeyearlyupper  =  <?php echo json_encode($commoncrimeyearlyupper) ?>;
  var commoncrimetotalyearlyupper =  <?php echo json_encode($commoncrimetotalyearlyupper) ?>;

   const chart12 =  Highcharts.chart('container12', {
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
            text: 'Top Most Occured Crimes/Incidents in Barangay Upper Bicutan  for the Current Month and Year',
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
            categories: commoncrimeyearlyupper
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
            data: commoncrimetotalupper, 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearlyupper, 
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

  var commoncrimetotalwestern   =  <?php echo json_encode($commoncrimetotalwestern ) ?>;
  var commoncrimeyearlywestern =  <?php echo json_encode($commoncrimeyearlywestern ) ?>;
  var commoncrimetotalyearlywestern =  <?php echo json_encode($commoncrimetotalyearlywestern  ) ?>;

   const chart13 =  Highcharts.chart('container13', {
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
            text: 'Top Most Occured Crimes/Incidents in Barangay Western Bicutan  for the Current Month and Year',
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
            categories: commoncrimeyearlywestern 
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
            data: commoncrimetotalwestern , 
            color:'orange'

        } ,

        {
            // type: 'column',
            name: 'Current Year',
            data: commoncrimetotalyearlywestern, 
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


