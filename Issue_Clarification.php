<?php
require 'PHP/connection.php';


function project_wise_analysis(){
echo ' <table border="1"><tr>
        
        <td width="130px" height="50px" rowspan="2"><b>Company</b></td>
        <td  colspan="7" align="center"><b>Issue Clarification</b></td></tr>
		
		<tr>
		<td width="20%">Bug defects</td>
		<td width="20%">Chargable Jobs</td>
		<td width="20%">Other</td>
		<td width="20%">Modification</td>
		<td width="20%">Development</td>
		<td width="20%">Internal Issue</td>
		<td width="20%">Training</td>
		<td width="20%">Support</td>
		<td width="20%">Total</td>
		</tr>';









		$sql2="SELECT (SELECT Company FROM mapping WHERE Project=C.PROJECT) COMP,
				SUM(Bug_defects),
				SUM(Chargable_Jobs),
				SUM(Other),
				SUM(Modification),
				SUM(Development),
				SUM(Internal_Issue), 
				SUM(ISSUES),
                SUM(Training),
				SUM(Support)
				
				FROM

				(SELECT DISTINCT PROJECT,
				(SELECT COUNT(*) FROM srf_plan WHERE PROJECT=A.PROJECT AND TRACKER='Chargable Jobs') Chargable_Jobs,
				(SELECT COUNT(*) FROM srf_plan WHERE PROJECT=A.PROJECT AND TRACKER='Bug-Defect') Bug_defects,
				(SELECT COUNT(*) FROM srf_plan WHERE PROJECT=A.PROJECT AND TRACKER='Other') Other,
				(SELECT COUNT(*) FROM srf_plan WHERE PROJECT=A.PROJECT AND TRACKER='Modification') Modification,
				(SELECT COUNT(*) FROM srf_plan WHERE PROJECT=A.PROJECT AND TRACKER='Development') Development,
				(SELECT COUNT(*) FROM srf_plan WHERE PROJECT=A.PROJECT AND TRACKER='Internal Issue') Internal_Issue,


				(SELECT COUNT(*) FROM srf_plan WHERE PROJECT=A.PROJECT) ISSUES,
				(SELECT COUNT(*) FROM srf_plan WHERE PROJECT=A.PROJECT AND TRACKER='Training') Training,
				(SELECT COUNT(*) FROM srf_plan WHERE PROJECT=A.PROJECT AND TRACKER='Support') Support
				FROM srf_plan A ORDER BY A.PROJECT) C

				GROUP BY COMP";
				
				
$result2=mysql_query($sql2);
$total_Bug=0;
$total_char=0;
$total_oth=0;
$total_mod=0;
$total_dev=0;
$total_int=0;
$total_train=0;
$total_sup=0;
$total_tot=0;

while($row2=mysql_fetch_array($result2)){

echo '<tr><td>'.$row2[0]."</td><td align='right'>".$row2[1]."</td>
	<td align='right'>".$row2[2]."</td>
	<td align='right'>".$row2[3]."</td>
	<td align='right'>".$row2[4]."</td>
    <td align='right'>".$row2[5]."</td>
    <td align='right'>".$row2[6]."</td>
	<td align='right'>".$row2[8]."</td>
	<td align='right'>".$row2[9]."</td>
	<td align='right'>".$row2[7]."</td>
     </tr>";
$total_Bug+=$row2[1];
$total_char+=$row2[2];
$total_oth+=$row2[3];
$total_mod+=$row2[4];
$total_dev+=$row2[5];
$total_int+=$row2[6];
$total_tot+=$row2[7];
$total_train+=$row2[8];
$total_sup+=$row2[9];
}

echo '<tr><td><b>Total</b></td><td align="center"><b>'.$total_Bug.'</b></td>';
echo '<td align="center"><b>'.$total_char.'</b></td>';
echo '<td align="center"><b>'.$total_oth.'</b></td>';
echo '<td align="center"><b>'.$total_mod.'</b></td>';
echo '<td align="center"><b>'.$total_dev.'</b></td>';
echo '<td align="center"><b>'.$total_int.'</b></td>';
echo '<td align="center"><b>'.$total_train.'</b></td>';
echo '<td align="center"><b>'.$total_sup.'</b></td>';
echo '<td align="center"><b>'.$total_tot.'</b></td>';
echo '</table>';
}

function display_graph(){
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
                beta: 40,
                depth: 50,
                viewDistance: 25
            }
        },
        title: {
            text: 'Project Wise Analysis'
        },
        subtitle: {
            text: 'Company Wise Analysis of Redmine Issues'
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
            name: 'Projects',
            colorByPoint: true,
            data: [";
			
$sql2="SELECT (SELECT Company FROM mapping WHERE Project=C.PROJECT) COMP, SUM(ISSUES)
        FROM
       (SELECT DISTINCT PROJECT,(SELECT COUNT(*) FROM srf_plan WHERE PROJECT=A.PROJECT) ISSUES
        FROM srf_plan A ORDER BY A.PROJECT) C
        GROUP BY COMP";
		
		
$result2=mysql_query($sql2);
$count=0;
while($row2=mysql_fetch_array($result2)){
			if($count==0){
			//$graph+="{name:'".$row2['PROJECT']."',y:".$row2[1]."}";
			echo "{name:'".$row2[0]."',y:".$row2[1]."}";
			}
			else{
			//$graph+=",{name:'".$row2['PROJECT']."',y:".$row2[1]."}";
			echo ",{name:'".$row2[0]."',y:".$row2[1]."}";
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
<script src="jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
<script src="jquery-1.11.2.min.js"></script>
<script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<?php display_graph(); ?>


 </head>
<?php require 'PHP/Menu.php';menu('srf_email'); ?>

<body>
<table><tr><td>
<?php project_wise_analysis(); ?>
</td>
<td width='80%'>
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