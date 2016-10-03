<head>

<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
<!-- Latest compiled JavaScript -->
<script src="jquery-1.11.2.min.js"></script>
<script src="JS/validate.js"></script>
<script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="CSS/Style.css">
<script>
function file_name(){

var val=document.Form1.work_plan.value;
alert(val);
document.Form1.work_lable.value=val;



}
</script>



<?php require 'PHP/Menu.php';menu('srf_upload'); ?>
</head>

<body>
<form enctype="multipart/form-data" action="PHP/srf-upload.php" method="post" name='Form1' >
<table align='center'>
<tr>
<td colspan='2'><h2>SRF Plan Uploader</h2></td>
</tr>
<tr>
	
	
	
	<td><input type="file" name="work_plan" id="work_plan" class='inputfile' onblur='file_details("file_details_1","work_plan")'  required /></td>
    <td><label class='inputfile_label' for="work_plan" name='work_label'  >&nbsp <span class="glyphicon glyphicon-upload" ></span>&nbsp SRF Plan Upload </label></td>
	<td><div id='file_details_1'><span class="glyphicon glyphicon-remove-sign" ></span></div></td>
</tr>	
	

<tr>	
<td colspan='2' align ='center'><input type="submit" value="Submit" id='submit_button' /></td>
</tr>	



</table>
</form>
</body>