<?php
require 'PHP/connection.php';


function issue_break(){

$sql="SELECT COUNT(*) FROM srf_plan";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

echo ' <table><tr>
        <td width="300px">&nbsp</td>
        <td width="150px" height="50px"><b>This Month</b></td>
        <td width="150px"><b>Last Month</b></td></tr>
		
		<tr><td height="50px"><b>Total number of issues</b></td>
		<td><b>'.$row[0].'</b></td>
		<td>xxx</td></tr>
		<tr></tr>
		';






$sql="SELECT DISTINCT TRACKER FROM srf_plan";
$result=mysql_query($sql);



while($row=mysql_fetch_array($result)){
$sql2="SELECT COUNT(*) FROM srf_plan WHERE TRACKER ='".$row['TRACKER']."'";
$result2=mysql_query($sql2);

while($row2=mysql_fetch_array($result2)){

echo '<tr><td>'.$row['TRACKER']."</td><td >".$row2[0]."</td><td>xx</td></tr>";
}

}
echo '</table>';
}

?>
<head>
<script src="jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
<script src="jquery-1.11.2.min.js"></script>
<script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>




 </head>
<?php require 'PHP/Menu.php';menu('srf_email'); ?>

<body>

<b>Report of issue analysis for the period from DD/MM/YYYY to DD/MM/YYYY</b> is attached here with.</br></br></br>
 
 
Support requests have been analyzed by using information in <b>Redmine</b>. The analysis was carried out to evaluate the support requests under the following classifications.
</br></br>
1. System Wise Analysis</br> 
2. Company Wise Analysis</br> 
3. Issue Clarifications – Company Wise Analysis</br> 
4. Chargeable Jobs Analysis</br></br>
 
 
The analysis has been produced in tables and graphical presentation.</br></br>

<?php issue_break();?>



</body>
