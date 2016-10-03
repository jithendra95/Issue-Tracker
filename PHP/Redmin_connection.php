<?php


//$conect=mysql_connect("localhost","root","");
$conect=mysql_connect("snpdsrv","redmine","abc321");
//$conect=mysql_connect("mysql7.000webhost.com","a5811667_jt","abc123");
if(!$conect)
{
  
    die("DB error:".mysql_error);
}
//mysql_select_db('expense_manager',$conect);
mysql_select_db('bitnami_redmine',$conect);
//mysql_select_db('a5811667_expense',$conect);


?>