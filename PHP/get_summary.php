<?php
$chkSql=$_GET["chksql"];
$switch_val=$_GET["switch_val"];
require  'Redmin_connection.php';


/****************Added for Completed % on 16-09-2016********************/
if($switch_val=="ON"){
 $m_filter_ratio="";
 }
 else if($switch_val=="OFF"){
 $m_filter_ratio="and done_ratio<>100";
 }
/***************************End******************************/ 
 
 
 
if($chkSql=='member'){
$list=array();

$sql="SELECT (select CONCAT(firstname ,' ', lastname) from bitnami_redmine.users where id=assigned_to_id)Name,
                     assigned_to_id, count(status_id) 
					 FROM bitnami_redmine.issues 
					 where status_id in(SELECT id FROM bitnami_redmine.issue_statuses where is_closed <> '1') 
					 ".$m_filter_ratio."
					 group by assigned_to_id
					 Order by Name";

$result=mysql_query($sql);
$i=0;
while($row=mysql_fetch_array($result)){
	  $member = array(
    "id" => $row["1"],
    "name" => $row["0"],
    "number_issues" => $row["2"]
	);
    
	$list[$i]=$member;
	$i++;
	 }

echo json_encode($list,JSON_PRETTY_PRINT);
}

else if($chkSql=='project_first'){
$list=array();
 
 $testing_status=$_GET["testing_status"];
 if($testing_status=='ON'){
 $status_filter='where status_id =\'8\'';
 $m_filter_ratio="";
 }else{
  $status_filter='where status_id in (SELECT id FROM bitnami_redmine.issue_statuses where is_closed <> \'1\')';
 }
 
$sql="SELECT (select name from bitnami_redmine.projects where id=project_id)Name,
                     project_id, count(status_id) 
					 FROM bitnami_redmine.issues  
					 ".$status_filter."
					 ".$m_filter_ratio."    
					 group by project_id
					 order by Name";				 
					 
//echo($sql);
$result=mysql_query($sql);
$i=0;
while($row=mysql_fetch_array($result)){
	  $member = array(
    "id" => $row["1"],
    "name" => $row["0"],
    "number_issues" => $row["2"]
	);
    
	$list[$i]=$member;
	$i++;
	 }

echo json_encode($list,JSON_PRETTY_PRINT);





}else if($chkSql=='projects'){
$members=json_decode($_GET['members']);
$list=array();
//array();


					 
$sql="SELECT (select name from bitnami_redmine.projects where id=project_id)Name,
                     project_id, count(project_id) 
					 FROM bitnami_redmine.issues 
					 where status_id in(SELECT id FROM bitnami_redmine.issue_statuses where is_closed <> '1') 
					 ".$m_filter_ratio."
					 AND assigned_to_id in( ";
					 
					 for($j=0;$j<sizeof($members);$j++){
					 if($j==(sizeof($members)-1)){
					 $sql=$sql."'".$members[$j]."'";
					 }else{
					 $sql=$sql."'".$members[$j]."',";}
					 
					 }
					 $sql=$sql.")group by project_id
					 ORDER BY Name";					 
					 
					 
					 
					 
$result=mysql_query($sql);


$i=0;
while($row=mysql_fetch_array($result)){
	  $project = array(
    "id" => $row["1"],
    "name" => $row["0"],
    "number_issues" => $row["2"]
	);
    
	$list[$i]=$project;
	$i++;
	 
	 
	 }
echo json_encode($list,JSON_PRETTY_PRINT);

/*foreach($members as $selected){
echo $selected;
}*/
}
else if($chkSql=='tracker'){
$projects=json_decode($_GET['projects']);
$list=array();
//array();
 $testing_status=$_GET["testing_status"];
 if($testing_status=='ON'){
 $status_filter='where status_id =\'8\'';
  $m_filter_ratio="";
 
 }else{
  $status_filter=' where status_id in (SELECT id FROM bitnami_redmine.issue_statuses where is_closed <> \'1\')';
 }
 

$sql="SELECT (select name from bitnami_redmine.trackers where id=tracker_id)Name,
                     tracker_id, count(project_id) 
					 FROM bitnami_redmine.issues 
					 ".$status_filter."
                     ".$m_filter_ratio."					 
					 AND project_id in(";
					 
					 for($j=0;$j<sizeof($projects);$j++){
					 if($j==(sizeof($projects)-1)){
					 $sql=$sql."'".$projects[$j]."'";
					 }else{
					 $sql=$sql."'".$projects[$j]."',";}
					 
					 }
					 $sql=$sql.")group by tracker_id
					 ORDER BY Name";					 
					 
					 
					 
					 
					 
$result=mysql_query($sql);


$i=0;
while($row=mysql_fetch_array($result)){
	  $project = array(
    "id" => $row["1"],
    "name" => $row["0"],
    "number_issues" => $row["2"]
	);
    
	$list[$i]=$project;
	$i++;
	 
	 
	 }
echo json_encode($list,JSON_PRETTY_PRINT);

/*foreach($members as $selected){
echo $selected;
}*/
}



else if($chkSql=='issue_detail'){
$members=json_decode($_GET['members']);
$projects=json_decode($_GET['projects']);
$list=array();
//array();

					 
					 $sql=" SELECT  id,
					  (SELECT name from bitnami_redmine.projects where id=project_id) Project_Name,
					  (SELECT name from bitnami_redmine.trackers where id=tracker_id),
					  (SELECT name from bitnami_redmine.issue_statuses where id=status_id),
					  subject,
					  description,
					  due_date,
					  start_date,
					  (SELECT CONCAT(firstname ,' ', lastname) from bitnami_redmine.users where id=assigned_to_id),
					  done_ratio
					  
					 FROM bitnami_redmine.issues 
					 where status_id in(SELECT id FROM bitnami_redmine.issue_statuses where is_closed <> '1') 
					 ".$m_filter_ratio."
					 AND assigned_to_id in( ";
					 
					 for($j=0;$j<sizeof($members);$j++){
					 if($j==(sizeof($members)-1)){
					 $sql=$sql."'".$members[$j]."'";
					 }else{
					 $sql=$sql."'".$members[$j]."',";}
					 
					 }
					 $sql=$sql.")
					 AND project_id IN(";
					 
					  for($j=0;$j<sizeof($projects);$j++){
					 if($j==(sizeof($projects)-1)){
					 $sql=$sql."'".$projects[$j]."'";
					 }else{
					 $sql=$sql."'".$projects[$j]."',";}
					 }
					 
					 $sql=$sql.")
					 ORDER BY Project_Name";
					 
					 
					 
			//	echo $sql;	 
			$result=mysql_query($sql);


$i=0;
while($row=mysql_fetch_array($result)){
	  $project = array(
    "id" => $row["0"],
    "project" => $row["1"],
    "tracker" => $row["2"],
	"status" => $row["3"],
    "subject" => $row["4"],
    "description" => $row["5"],
	"start_date" => $row["7"],
    "due_date" => $row["6"],
    "assigned_to" => $row["8"],
	"done_ratio" => $row["9"]
	);
    
	$list[$i]=$project;
	$i++;
	 
	 
	 }
echo json_encode($list,JSON_PRETTY_PRINT);

/*foreach($members as $selected){
echo $selected;
}*/
}
else if($chkSql=='issue_detail_tracker'){
$projects=json_decode($_GET['project']);
$tracker=json_decode($_GET['tracker']);
$list=array();

 $testing_status=$_GET["testing_status"];
 if($testing_status=='ON'){
 $status_filter='where status_id =\'8\'';
 $m_filter_ratio="";
 }else{
  $status_filter='where status_id in (SELECT id FROM bitnami_redmine.issue_statuses where is_closed <> \'1\')';
 }
//array();
					 
                 $sql=" SELECT  id,
					  (SELECT name from bitnami_redmine.projects where id=project_id) Project_Name,
					  (SELECT name from bitnami_redmine.trackers where id=tracker_id),
					  (SELECT name from bitnami_redmine.issue_statuses where id=status_id),
					  subject,
					  description,
					  due_date,
					  start_date,
					  (SELECT CONCAT(firstname ,' ', lastname) from bitnami_redmine.users where id=assigned_to_id),
					  done_ratio
					  
					 FROM bitnami_redmine.issues 
					 ".$status_filter."
					 ".$m_filter_ratio."
					 AND project_id in( ";
					 
					for($j=0;$j<sizeof($projects);$j++){
					 if($j==(sizeof($projects)-1)){
					 $sql=$sql."'".$projects[$j]."'";
					 }else{
					 $sql=$sql."'".$projects[$j]."',";}
					 
					 }
					 $sql=$sql.")
					 AND tracker_id IN(";
					 
					  for($j=0;$j<sizeof($tracker);$j++){
					 if($j==(sizeof($tracker)-1)){
					 $sql=$sql."'".$tracker[$j]."'";
					 }else{
					 $sql=$sql."'".$tracker[$j]."',";}
					 }
					 
					 $sql=$sql.")
					
					 ORDER BY Project_Name";
					 
					 
					 
					// and id not in('13309','14152','13646') 
					 
					 
					 
				//echo $sql;	 
			$result=mysql_query($sql);


$i=0;
while($row=mysql_fetch_array($result)){
	  $project = array(
    "id" => $row["0"],
    "project" => $row["1"],
    "tracker" => $row["2"],
	"status" => $row["3"],
    "subject" => $row["4"],
    "description" => $row["5"],
	"start_date" => $row["7"],
    "due_date" => $row["6"],
    "assigned_to" => $row["8"],
	"done_ratio" => $row["9"]
	);
    
	$list[$i]=$project;
	$i++;
	 
	 
	 }
echo json_encode($list,JSON_PRETTY_PRINT);

/*foreach($members as $selected){
echo $selected;
}*/
}




?>