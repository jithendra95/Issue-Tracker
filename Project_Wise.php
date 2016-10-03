
<head>
<script src="jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
<script src="jquery-1.11.2.min.js"></script>
<script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<link rel="stylesheet" href="CSS/Style.css">


<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.datepick.css"> 
<script src="http://keith-wood.name/js/jquery.plugin.js"></script>
<script src="http://keith-wood.name/js/jquery.datepick.js"></script>

<script>

function run_report(){
start_date=document.Form1.start_date.value;
end_date=document.Form1.end_date.value;
//alert(start_date);
m_url="PHP/Project_wise_graph.php?chksql='project'&start_date="+start_date+"&end_date="+end_date;
window.open(m_url);
/*$.ajax({

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


     })*/
 }
 
 $(function() {
	$("#start_date,#end_date").datepick({dateFormat: 'yyyy-mm-dd'});
});

</script>

<?php require 'PHP/Menu.php';menu('srf_email'); ?>
<div class="container">
<form name='Form1'>




<div class="row">
  <div class="col-sm-4"><b>Start Date* </b><input type='text' value='' class='input_field' name='start_date' id='start_date'  ></div>
  <div class="col-sm-6"><b>End Date * </b><input type='text' value='' class='input_field' name='end_date' id='end_date' >&nbsp <input type='button' id='form_button' value='View Report' onclick='run_report()'></div>
  <div class="col-sm-2"></div>
</div>

</div>
</body>
</form>
