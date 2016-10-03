<?php

require 'PHP/Redmin_connection.php';
$sql="select count(*) test_count from bitnami_redmine.issues
where due_date='2016-09-05' 
and  status_id not in('1','2','3','4','9') ";
$result=mysql_query($sql);

while($row=mysql_fetch_array($result)){

echo $row['test_count'];

}


?>