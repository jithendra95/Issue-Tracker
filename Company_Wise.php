<?php
require 'PHP/connection.php';


function project_wise_analysis(){
/*echo ' <table border="1"><tr>
        
        <td width="130px" height="50px"><b>Company</b></td>
        <td width="130px"><b>Number of Issues</b></td></tr>';


*/






$sql2="SELECT (SELECT Company FROM mapping WHERE Project=C.PROJECT) COMP, SUM(ISSUES)

        FROM

       (SELECT DISTINCT PROJECT,(SELECT COUNT(*) FROM srf_plan WHERE PROJECT=A.PROJECT) ISSUES
        FROM srf_plan A ORDER BY A.PROJECT) C

        GROUP BY COMP";
$result2=mysql_query($sql2);
$total=0;
$count=1;
while($row2=mysql_fetch_array($result2)){

//echo '<tr><td>'.$row2[0]."</td><td align='right'>".$row2[1]."</td></tr>";
echo '{ind:"'.$count.'",company:"'.$row2[0].'",amount:"'.$row2[1].'"},';
$count++;
$total+=$row2[1];
}
/*
echo '<tr><td><b>Total</b></td><td align="center"><b>'.$total.'</b></td></tr>';
echo '</table>';*/

//		echo '{ind:"'.$count.'",company:"Total",amount:"'.$total.'"}';
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
            name: 'Issues',
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

<link rel="stylesheet" type="text/css" media="screen" href="jq_ui/jquery-ui.theme.css" />
<link rel="stylesheet" type="text/css" media="screen" href="jq_grid/css/ui.jqgrid.css" />


<script src="jq_grid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="jq_grid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
<?php display_graph(); ?>


 </head>
<?php require 'PHP/Menu.php';menu('srf_email'); ?>

<body>
<table><tr><td>
<?php //project_wise_analysis(); ?>
<table id="list4"></table>
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


<script>
jQuery("#list4").jqGrid({
	datatype: "local",
	height: 500,
   	colNames:['Index','Inv No','Amount'],
   	colModel:[
	    {name:'ind',index:'ind', width:40, align:"right",sortable:false},
   		{name:'company',index:'company', width:150,sortable:false},
   		//{name:'invdate',index:'invdate', width:90, sorttype:"date"},
   		//{name:'name',index:'name', width:100},
   		{name:'amount',index:'amount', width:80, align:"right",sortable:false}
   		/*{name:'tax',index:'tax', width:80, align:"right",sorttype:"float"},		
   		{name:'total',index:'total', width:80,align:"right",sorttype:"float"},		
   		{name:'note',index:'note', width:150, sortable:false}	*/	
   	],
   //	multiselect: true,
   	caption: "Company Wise Issue Analysis",
	sortname: 'company',
	viewrecords: true,
    sortorder: "desc",
    loadonce: true,
	footerrow: true,
    gridComplete: function() {
        var $grid = $('#list4');
        var colSum = $grid.jqGrid('getCol', 'amount', false, 'sum');
		$grid.jqGrid('footerData', 'set', { 'company': 'Total'});
        $grid.jqGrid('footerData', 'set', { 'amount': colSum });
    }
});


var mydata = [
/*
		{id:"1",invdate:"2007-10-01",name:"test",note:"note",amount:"200.00",tax:"10.00",total:"210.00"},
		{id:"2",invdate:"2007-10-02",name:"test2",note:"note2",amount:"300.00",tax:"20.00",total:"320.00"},
		{id:"3",invdate:"2007-09-01",name:"test3",note:"note3",amount:"400.00",tax:"30.00",total:"430.00"},
		{id:"4",invdate:"2007-10-04",name:"test",note:"note",amount:"200.00",tax:"10.00",total:"210.00"},
		{id:"5",invdate:"2007-10-05",name:"test2",note:"note2",amount:"300.00",tax:"20.00",total:"320.00"},
		{id:"6",invdate:"2007-09-06",name:"test3",note:"note3",amount:"400.00",tax:"30.00",total:"430.00"},
		{id:"7",invdate:"2007-10-04",name:"test",note:"note",amount:"200.00",tax:"10.00",total:"210.00"},
		{id:"8",invdate:"2007-10-03",name:"test2",note:"note2",amount:"300.00",tax:"20.00",total:"320.00"},
		{id:"9",invdate:"2007-09-01",name:"test3",note:"note3",amount:"400.00",tax:"30.00",total:"430.00"}*/
		<?php project_wise_analysis(); ?>
		];
for(var i=0;i<=mydata.length;i++)
	jQuery("#list4").jqGrid('addRowData',i+1,mydata[i]);

</script>

</body>