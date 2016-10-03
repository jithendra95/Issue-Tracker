<?php
//require 'Redmin_connection.php';
require 'Redmin_connection.php';

/*$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$chk_sql=$_GET['chksql'];*/



function display_graph(){

$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$chk_sql=$_GET['chksql'];

$graph='';
//$graph+="<script>
  echo "  <script> $(function () {
    // Set up the chart
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 0,
                beta: 0,
                depth: 50,
                viewDistance: 25
            }
        },
        title: {
            text: 'Project Wise Analysis'
        },
        subtitle: {
            text: ' From ".$start_date." To ".$end_date. "'
        },xAxis: {
            type: 'category'
        },
		yAxis: {
            title: {
                text: 'Number of Issues'
            }},
        plotOptions: {
            column: {
                depth: 25
            }
        },
        series: [{
            name: 'Issues',
            colorByPoint: true,
            data: [";
			

		
	$sql2=	"  SELECT  
        (SELECT name FROM bitnami_redmine.projects WHERE id=A.project_id) PROJECT,
         COUNT(*) NUM
        FROM bitnami_redmine.issues A 
        GROUP BY PROJECT ";
		
$result2=mysql_query($sql2);
$count=0;
while($row2=mysql_fetch_array($result2)){
			if($count==0){
			//$graph+="{name:'".$row2['PROJECT']."',y:".$row2[1]."}";
			echo "{name:'".$row2['PROJECT']."',y:".$row2[1]."}";
			}
			else{
			//$graph+=",{name:'".$row2['PROJECT']."',y:".$row2[1]."}";
			echo ",{name:'".$row2['PROJECT']."',y:".$row2[1]."}";
			}
		    $count++;
			}
		
			//{name:'TEsr',y:29.9}, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4
			
//$graph+="]
echo "]
        }]
    });

    function showValues() {
        $('#alpha-value').html(chart.options.chart.options3d.alpha);
        $('#beta-value').html(chart.options.chart.options3d.beta);
        $('#depth-value').html(chart.options.chart.options3d.depth);
    }

    // Activate the sliders
    $('#sliders input').on('input change', function () {
        chart.options.chart.options3d[this.id] = this.value;
        showValues();
        chart.redraw(false);
    });

    showValues();
});
</script>";

//echo $graph;


}




function display_graph2(){

$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$chk_sql=$_GET['chksql'];

$graph='';
//$graph+="<script>
  echo "  <script> $(function () {

    $(document).ready(function () {

        // Build the chart
        $('#container2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Browser market shares January, 2015 to May, 2015'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                    name: 'Microsoft Internet Explorer',
                    y: 56.33
                }, {
                    name: 'Chrome',
                    y: 24.03,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Firefox',
                    y: 10.38
                }, {
                    name: 'Safari',
                    y: 4.77
                }, {
                    name: 'Opera',
                    y: 0.91
                }, {
                    name: 'Proprietary or Undetectable',
                    y: 0.2
                }]
            }]
        });
    });
});
</script>";

//echo $graph;


}


function display_graph3(){

$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$chk_sql=$_GET['chksql'];

$graph='';
//$graph+="<script>
  echo "  <script> $(function () {
    $('#container3').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Browser market shares at a specific website, 2014'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Firefox', 45.0],
                ['IE', 26.8],
                {
                    name: 'Chrome',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari', 8.5],
                ['Opera', 6.2],
                ['Others', 0.7]
            ]
        }]
    });
});
</script>";

//echo $graph;


}


?>
<style>

.div1 {
    box-shadow: 10px 10px 5px #888;
	height:550px;
}

</style>

<head>
<script src="../jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
<script src="../jquery-1.11.2.min.js"></script>
<script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<?php display_graph();display_graph2();display_graph3(); ?>
<script>

function chk_ajax(){
$.ajax({

type:'POST',
data:{chk_sql:"expense"},
url:"PHP/Company_wise_graph.php",
success:function(result){
//alert(result);
alert('Expense Save Sucessfully');
document.getElementById('test').innerHTML=result;
//window.location.assign("");


//check_num();
}


     })
 }

</script>

 </head>

<body>

<div class="container-fluid">

<div  align='left'  class='row'> 

<div class='col-sm-4  div1'>
<div id="container"></div>
</div>
	  
<div class='col-sm-4  div1'>
<div id="container2"></div>
</div>	  
	  
<div class='col-sm-4  div1'> 
<div id="container3"></div>
</div>
	  
   </div>
   
   
   
   <div  align='left'  class='row'> 

<div class='col-sm-4  div1'>
<div id="container"></div>
</div>
	  
<div class='col-sm-4  div1'>
<div id="container2"></div>
</div>	  
	  
<div class='col-sm-4  div1'> 
<div id="container3"></div>
</div>
	  
   </div>
   
   
</div>

</body>