<html>

<head>
<script src="jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
<script src="jquery-1.11.2.min.js"></script>
<script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>




 </head>
<?php require 'PHP/Menu.php';menu('daily_email'); ?>
<?php require 'PHP/Daily_Email.php'?>

<body>
Please find the attachment of consolidated work plan as of <?php echo $today_date?>.
<br/>
<br/>
<br/>
<table>
<tr>
<td width='300px'></td>
<td width='100px'>Today</td>
<td width='100px'>Yesterday</td>
</tr>

<tr>

<td width='300px' >Total No. of issues</td>
<td width='100px'><?php echo $all_issues?></td>
<td width='100px'>xxx</td>

</tr>

<tr>

<td width='300px' >Percentage = 100 issues </td>
<td width='100px'><?php echo $equal_hundred?></td>
<td width='100px'>xxx</td>

</tr>

<tr>

<td width='300px'> Outstanding issues </td>
<td width='100px'><?php echo $not_hundred?></td>
<td width='100px'>xxx</td>

</tr>

</table>
<br/>
<?php echo $excep_data; ?>
<br/>
<table>
<tr><td><b>Expected to be completed today- <?php echo $expected_comp?></td></tr>
<tr><td><b>Actual completions for today- <?php echo ($expected_comp-$no_exep)?></td></tr>
<tr><td><b>Achievement - <?php echo $excep_comp_per?></td></tr>
</table>

<br/>
<b>Exceptions-100%<br/>
<?php echo $excep_data2; ?>
<br/>
<table>
<tr><td><b>Expected to be completed today- <?php echo $expected_comp_100_per?></td></tr>
<tr><td><b>Actual completions for today- <?php echo ($expected_comp_100_per-$no_exep2)?></td></tr>
<tr><td><b>Achievement - <?php echo $excep_comp_per2?></td></tr>
</table>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


</body>






</html>