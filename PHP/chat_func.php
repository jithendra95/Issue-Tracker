<?php
session_start();


$chksql=$_POST['chksql'];

require  'connection.php';

switch($chksql){
case 'send':send_message();break;
case 'read':read_message();break;
case 'create':create_chat();break;
}


function send_message(){

$user=$_SESSION['chat__user'];
$chat_id=$_SESSION['chat_id'];

$message=$_POST['message'];

if($message!=""){
$sql="INSERT INTO `chat_log`(CHAT_ID,`CHAT_USER`, `CHAT_MESSAGE`) 
      VALUES ('".$chat_id."','".$user."','".$message."')";
		
		$result=mysql_query($sql);}
		read_message();
		
		}

		
		function read_message(){
		
 		$user=$_SESSION['chat__user'];
        $chat_id=$_SESSION['chat_id'];

		$sql="SELECT CHAT_ID, CHAT_USER, CHAT_MESSAGE, ENT_TIME_STAMP FROM chat_log WHERE CHAT_ID='".$chat_id."' ORDER BY ENT_TIME_STAMP ";
		//echo $sql;
		
		
		$result=mysql_query($sql);
		
		$message_arr= Array();
		$i=0;
		while($row=mysql_fetch_array($result)){
		if($row["CHAT_USER"]==$user){
			  $message = array(
			
			"user" => $row["CHAT_USER"],
			"message" => $row["CHAT_MESSAGE"],
			"user_type"=>'user'
			);
			}else{
			
			$message = array(
			
			"user" => $row["CHAT_USER"],
			"message" => $row["CHAT_MESSAGE"],
			"user_type"=>'other'
			);
			}
			$message_arr[$i]=$message;
			$i++;
			 }

		echo json_encode($message_arr,JSON_PRETTY_PRINT);

		}
		
	function create_chat(){
	
	$chat_name=$_POST['chat_name'];
	
	$sql="INSERT INTO `chat_record`(CHAT_NAME) 
      VALUES ('".$chat_name."')";
		
		$result=mysql_query($sql);
		
	$sql="SELECT CHAT_ID FROM chat_record WHERE CHAT_NAME='".$chat_name."'";
	$result=mysql_query($sql);
	//echo $sql;
	
	
	if($row=mysql_fetch_array($result)){
	echo $row["CHAT_ID"];
	}else{
	echo 'Failed';
	}	
		
		}
		
?>