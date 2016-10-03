<?php
require 'Redmin_connection.php';

/*$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$chk_sql=$_GET['chksql'];*/

function project_wise_analysis(){

$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$chk_sql=$_GET['chksql'];

echo ' <table border="1"><tr>
        
        <td width="130px" height="50px"><b>Project</b></td>
        <td width="130px"><b>Number of Issues</b></td></tr>';



		
$sql2=	" SELECT  
        (SELECT name FROM bitnami_redmine.projects WHERE id=A.project_id) PROJECT,
         COUNT(*) NUM
        FROM bitnami_redmine.issues A 
        WHERE created_on >= '".$start_date."'
        AND   created_on <=  '".$end_date."'
        GROUP BY PROJECT ";		
		
		//echo $sql2;
		
$result2=mysql_query($sql2);
$total=0;
while($row2=mysql_fetch_array($result2)){

echo '<tr><td>'.$row2['PROJECT']."</td><td align='right'>".$row2[1]."</td></tr>";
$total+=$row2[1];
}

echo '<tr><td><b>Total</b></td><td align="center"><b>'.$total.'</b></td></tr>';
echo '</table>';
}

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
        WHERE created_on >= '".$start_date."'
        AND   created_on <=  '".$end_date."'
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

?>


<head>
<script src="../jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
<script src="../jquery-1.11.2.min.js"></script>
<script src="../bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<?php display_graph(); ?>
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
<table><tr><td>
<?php //project_wise_analysis(); ?>&nbsp
</td>
<td width='100%'>
<div id="container"></div>
<div id="sliders">
    <table align='center'>
        <tr>
        	<td>Alpha Angle</td>
        	<td><input id="alpha" type="range" min="0" max="45" value="15"/> <span id="alpha-value" class="value"></span></td>
        </tr>
        <tr>
        	<td>Beta Angle</td>
        	<td><input id="beta" type="range" min="-45" max="45" value="15"/> <span id="beta-value" class="value"></span></td>
        </tr>
        <tr>
        	<td>Depth</td>
        	<td><input id="depth" type="range" min="20" max="100" value="50"/> <span id="depth-value" class="value"></span></td>
        </tr>
    </table>
</div>
</td></tr></table>

</body>