<html>
<head>
<title>Begin Chat</title>
</head>

<script src="jquery-1.11.2.min.js"></script>
<script>
function onclick_validation(){

if(document.Form1.user.value==""){
alert('Please Enter Username');
document.Form1.user.focus();
return false;
}else{
return true;

}

}


function click_function(val){
if(onclick_validation()){

if(val=='join'){
document.Form1.hid_sub_type.value='join';
 var chat_id=prompt("Enter Chat Id");
 submit_chat_id(chat_id);
}else if(val=='start'){
document.Form1.hid_sub_type.value='start';
 var chat_name=prompt("Enter New Chat Name");
 
if(chat_name!=''){
document.Form1.hid_chat_name.value=chat_name;
//alert('Reached');
$.ajax({

type:'POST',
data:{chksql:"create",chat_name:chat_name},
url:"PHP/chat_func.php",
success:function(result){
submit_chat_id(result);
//alert(result);
}


     })
	 
}
}

}

}


function submit_chat_id(chat_id){

document.Form1.hid_chat_id.value=chat_id;
if(chat_id!=''){
//alert('Reached');
Form1.submit();
}

}


</script>


<body>
<form name='Form1' action='Chat_page.php' method='POST'>
<input type='hidden' value='' name='hid_sub_type'>
<input type='hidden' value='' name='hid_chat_id'>
<input type='hidden' value='' name='hid_chat_name'>
<input type='Button' value='Start New Chat' onclick='click_function("start")'>
<input type='Button' value='Join Chat' onclick='click_function("join")'><br/>
<input type='text' placeholder='Username' name='user' id='user'>
</form>
</body>


</html>