<?php
$chkSql=$_GET["chksql"];
//require  'connection.php';
require  'Redmin_connection.php';

 

if($chkSql=='charge_project'){
$list=array();
 
 
 
$sql="SELECT (select name from bitnami_redmine.projects where id=project_id)Name,
                     project_id, count(status_id) ,
					 sum(B.value)
					 FROM bitnami_redmine.issues A,bitnami_redmine.custom_values B
                     WHERE A.id=B.customized_id
					 and tracker_id='20'	
					 and custom_field_id='5'
					 group by project_id
					 order by Name";				 
					 
//echo $sql;
$result=mysql_query($sql);
$i=0;
while($row=mysql_fetch_array($result)){
	  $member = array(
    "id" => $row["1"],
    "name" => $row["0"],
    "number_issues" => $row["2"],
	"charge_amount" => $row["3"]
	);
    //echo $row["1"];
	$list[$i]=$member;
	$i++;
	 }

echo json_encode($list,JSON_PRETTY_PRINT);


}else if($chkSql=='charge_status'){

$projects=json_decode($_GET['projects']);
$list=array();
 
 
 
$sql="select Name,CHG,count(CHG),sum(Amount)
from

(SELECT (select name from bitnami_redmine.projects where id=project_id)Name,
                     project_id,
                     (select C.value from bitnami_redmine.custom_values C where custom_field_id='5' and C.customized_id=A.id  ) Amount,
					 B.value CHG
					 FROM bitnami_redmine.issues A,bitnami_redmine.custom_values B
                     WHERE A.id=B.customized_id
					 and tracker_id='20'	
					 and custom_field_id='6'
					 and project_id in(";
					 
					 for($j=0;$j<sizeof($projects);$j++){
					 if($j==(sizeof($projects)-1)){
					 $sql=$sql."'".$projects[$j]."'";
					 }else{
					 $sql=$sql."'".$projects[$j]."',";}
					 
					 }
					 $sql=$sql.")
					 
					 union
					 
					 SELECT (select name from bitnami_redmine.projects where id=project_id)Name,
                     project_id, B.value,
					 'Quotation Exceptions' 
					 FROM bitnami_redmine.issues A,bitnami_redmine.custom_values B
                     WHERE A.id=B.customized_id
					 and tracker_id='20'	
					 and custom_field_id='5'
					 and project_id in(";
					 
					 for($j=0;$j<sizeof($projects);$j++){
					 if($j==(sizeof($projects)-1)){
					 $sql=$sql."'".$projects[$j]."'";
					 }else{
					 $sql=$sql."'".$projects[$j]."',";}
					 
					 }
					 $sql=$sql.")
					 and B.customized_id not in(select customized_id from custom_values where custom_field_id='6' )
                     )D
					 group by CHG
					 order by Name";				 
					 
//echo $sql;
$result=mysql_query($sql);
$i=0;
while($row=mysql_fetch_array($result)){
	  $member = array(
    "id" => $row["1"],
    "name" => $row["1"],
    "number_issues" => $row["2"],
	"charge_amount" => $row["3"]
	);
    //echo $row["1"];
	$list[$i]=$member;
	$i++;
	 }

echo json_encode($list,JSON_PRETTY_PRINT);


}

?>