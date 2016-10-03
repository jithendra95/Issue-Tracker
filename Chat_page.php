<HTML>
<head>
<?php
session_start();
if(isset($_POST['hid_chat_id'])){
$_SESSION['chat_id']=$_POST['hid_chat_id'];
$_SESSION['chat__user']=$_POST['user'];}

?>
<title>Chat Page</title>
<style>

body {
    margin: 0;
    padding: 0;
	font-family:Sans-serif;
}


#messages{


height:400px;
overflow:auto;
overflow-x:hidden

}

.chat_bubble{
margin-top:5px;
background-color:#345;
color:white;
width:250px;
border-radius:5px;

}

.user_msg{
margin-left:420px;
}

.transition {
-webkit-transition: all 0.85s ease;
    -webkit-transform: scale(1.2); 
    -moz-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
	//margin-left:15px;
}

.header{

background-color:#add8e6;
color:white;
border-radius:5px;
font-size:25px;
font-weight: bold
text-align:center;

}

#user_name_div{

font-size:10px;
font-weight: bold

}

#message_div{
font-size:15px;
margin-top:5px;
}

#msg_text{
width:750px;
height:30px;
}

#send_image{
height:20px;
width:30px;
margin-top:-20px;

}
</style>






<script src="jquery-1.11.2.min.js"></script>
<script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">

<script>

var notify_msg='';
var notify_user='';
var global_user='<?php echo $_SESSION['chat__user'];?>';

function check_notification_permission(){

if(!window.Notification){
alert('Sorry Notifications Not allowed');
}else{
Notification.requestPermission(function (p){
if(p==='granted'){
}else if(p==='denied'){
alert('Please Grant Permisson for Notification if you Want to Continue');
}
});

}


}


function show_notification(message_obj){

check_notification_permission();
if(Notification.prmission==='default'){
alert("Please Allow Notifications");
}else{
//alert(message_obj.user+":"+global_user);
//if(message_obj.user!=global_user){
if(notify_msg!=message_obj.message && notify_user!=message_obj.user ){

notify_msg=message_obj.message;
notify_user=message_obj.user;

notify =new Notification(message_obj.user+" Sent a Message",{
         body:message_obj.message,
         icon:'images/message.ico'});
		 
		 setTimeout(function(){
            notify.close();
            }, 2000);}
		 }
		// }
}

function read_message(){

 $.ajax({

type:'POST',
data:{chksql:"read"},
url:"PHP/chat_func.php",
success:function(result){
display_messages(result,'read');


}


     })
	 
}

function send_message(){
 /*var msg=document.getElementById('messages').innerHTML;
 document.getElementById('messages').innerHTML=msg+'<br/>'+document.Form1.message_area.value;
 document.Form1.message_area.value='';*/
 
message=document.Form1.message_area.value;

 $.ajax({

type:'POST',
data:{chksql:"send",message:message},
url:"PHP/chat_func.php",
success:function(result){
display_messages(result,'send');
document.Form1.message_area.value="";
updateScroll();
}


     })
}

function display_messages(result,display_type){


var messages_arr=JSON.parse(result);
var length=messages_arr.length;		 
var data="";		  
for(i=0;i<length;i++){
//data=data+"<tr id='record_row'><td><input class='user_list' type='checkbox' name='user_list[]' value='"+list[i].id+"' onchange='tracker_pending()'></td><td>"+list[i].name+"</td><td>"+list[i].number_issues+"</td></tr>";
//data=data+"<div align=\"center\"><div id='user_name_div'>"+messages_arr[i].user+"</div><div id='message_div'> "+messages_arr[i].message+"</div></div>";
data=data+create_message_layout(messages_arr[i]);

if(display_type=='read'){
if(i==(length-1)){
show_notification(messages_arr[i]);
}}
//data=data+list[i]+"</br>";

}
//alert(list);

document.getElementById("messages").innerHTML=data;//list['author'];



}


function create_message_layout(message_obj){

if(message_obj.user_type=='user'){

message_layout="<div  align='left'  class='row'>";
message_layout=message_layout+" <div class='col-sm-1'> &nbsp </div>";
message_layout=message_layout+"<div class='col-sm-4'>";
message_layout=message_layout+" <div  class='chat_bubble user_msg'><div id='user_name_div'>"+message_obj.user+"</div><div id='message_div'> "+message_obj.message+"</div></div><br/>";
message_layout=message_layout+"</div>";
message_layout=message_layout+" <div class='col-sm-3'> &nbsp </div>";
message_layout=message_layout+"</div>";

}else{

message_layout="<div  align='left'  class='row'>";
message_layout=message_layout+"<div class='col-sm-4'>";
message_layout=message_layout+"<div class='chat_bubble' ><div id='user_name_div'>"+message_obj.user+"</div><div id='message_div'> "+message_obj.message+"</div></div><br/>";
message_layout=message_layout+"</div>";
message_layout=message_layout+" <div class='col-sm-8'> &nbsp </div>";
message_layout=message_layout+"</div>";
}
return message_layout;
}

function load_mesage(){

//global_user=document.Form1.global_user.value;
setInterval(function(){read_message();}, 2000);

}

function processKey(e)
{
   if (null == e)
        e = window.event ;
    if (e.keyCode == 13)  {//Enter Key
	    
		e.preventDefault();
        send_message();
    }
}


function updateScroll(){
    var element = document.getElementById("messages");
    element.scrollTop = element.scrollHeight;
}



$(document).ready(function(){

    $("#send_image").hover(function(){

$(this).addClass('transition');}
,function(){
$(this).removeClass('transition');
        });
		
	
		});
</script>


</head>
<body onload='load_mesage();updateScroll();	'>
<div class="container-fluid">
<!--input type='button'  value='test_notify' onclick='show_notification()'-->

<div  align='left'  class='row'> 
 <div class='col-sm-2'> &nbsp </div>
 
   <div class='col-sm-7  header' >Chat ID : <?php echo $_SESSION['chat_id'];?>  </div>
    <div class='col-sm-3'> &nbsp </div>
  </div>
  
</div>




 <div  align='left'  class='row'> 
 <div class='col-sm-2'> &nbsp </div>
 
   <div class='col-sm-7'> <div id='messages'></div> 
    <div class='col-sm-3'> &nbsp </div>
  </div>
  
</div>


 <div  align='left'  class='row'> 
 <div class='col-sm-2'> &nbsp </div>
 
 <div class='col-sm-7'>
<form name='Form1'>
<textarea name='message_area' id='msg_text' onkeydown=" processKey(event)" placeholder='Write a message .......'></textarea>
<img  src='images/send.png' id='send_image'onclick='send_message();'>
</div>
 <div class='col-sm-3'> &nbsp </div>

<input type='hidden' value='' name='global_user'>


</div>

</form>
</div>
</body>

</HTML>