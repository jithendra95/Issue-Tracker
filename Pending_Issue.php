<html>
<head>

<script src="jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="CSS/style.css">
<link rel="stylesheet" href="CSS/side_menu.css">
<link rel="stylesheet" href="CSS/switch.css">
<script src="jquery-1.11.2.min.js"></script>
<script src="JS/menu.js"></script>
<script src="JS/graph.js"></script>
<script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<style>

#switch{

margin-left:1200px;
margin-top:-15px;

}

a{
cursor:hand;
}


</style>
<script>

/*****************************Function Called When Menu Item is Selected********************/
function choose_option(val){

if(val=="members"){
document.Form1.screen_status.value='members';
member_pending();


}else if(val=="projects"){
document.Form1.screen_status.value='projects';
project_pending_first();
document.Form1.testing_status.value='';
}else if(val=="testing"){
document.Form1.screen_status.value='testing';
document.Form1.testing_status.value='ON';
project_pending_first();
}else if(val=="chargeable"){
document.Form1.screen_status.value='chargeable';
chargeable_project();
}


}
//////////////////////////////Main Menu Functions Start/////////////////////////////////
/********Get Pending Issues Member Wise***********************/
function member_pending(){

closeNav();

$(".loading_img").css({"display": "block"}); 
document.getElementById("list2").innerHTML="";//list['author'];
document.getElementById("list3").innerHTML="";
switch_val=document.Form1.switch_status.value;

$.ajax({

type:'GET',
data:{chksql:"member",switch_val:switch_val},
url:"PHP/get_summary.php",
success:function(result){

var list=JSON.parse(result);

var length=list.length;
		  data="<table class=\"table table-striped\" >";
		  data=data+"<thead>";
		  data=data+" <tr style=\"background-color:#69C7D6;\">";
		  data=data+" <th>Select</br><input type='checkbox' name='tick_all_mem'  onchange=\"tick_all('member')\" ></th>";
		  data=data+"<th>Assigned to</th>";
		  data=data+" <th>Number of Issues</th>";
		  data=data+" </tr>";
	      data=data+"</thead><tbody>";
		  
		  m_total=0;
for(i=0;i<length;i++){
data=data+"<tr id='record_row'><td><input class='user_list' type='checkbox' name='user_list[]' value='"+list[i].id+"' onchange='project_pending()'></td><td>"+list[i].name+"</td><td>"+list[i].number_issues+"</td></tr>";
m_total=m_total+Number(list[i].number_issues);
//data=data+list[i]+"</br>";

}
data=data+"<tr id='record_total'><td> &nbsp </td><td><b>Total</td><td><b>"+m_total+"</td></tr>";
data=data+"<tbody></table>";
//alert(list);

document.getElementById("list1").innerHTML=data;//list['author'];
$(".loading_img").css({"display": "none"}); 




}


     })
}

/********Get Pending Issues Project Wise***********************/
function project_pending_first(){

closeNav();

$(".loading_img").css({"display": "block"}); 
document.getElementById("list2").innerHTML="";//list['author'];
document.getElementById("list3").innerHTML="";
switch_val=document.Form1.switch_status.value;
testing_status=document.Form1.testing_status.value;

$.ajax({

type:'GET',
data:{chksql:"project_first",switch_val:switch_val,testing_status:testing_status},
url:"PHP/get_summary.php",
success:function(result){

var list=JSON.parse(result);

var length=list.length;
		  data="<table class=\"table table-striped\" >";
		  data=data+"<thead>";
		  data=data+" <tr style=\"background-color:#69C7D6;\">";
		  data=data+" <th>Select</br><input type='checkbox' name='tick_all_mem'  onchange=\"tick_all('member')\" ></th>";
		  data=data+"<th>Project</th>";
		  data=data+" <th>Number of Issues</th>";
		  data=data+" </tr>";
	      data=data+"</thead><tbody>";
		  
		  m_total=0;
for(i=0;i<length;i++){
data=data+"<tr id='record_row'><td><input class='user_list' type='checkbox' name='user_list[]' value='"+list[i].id+"' onchange='tracker_pending()'></td><td>"+list[i].name+"</td><td>"+list[i].number_issues+"</td></tr>";
m_total=m_total+Number(list[i].number_issues);
//data=data+list[i]+"</br>";

}
data=data+"<tr id='record_total'><td> &nbsp </td><td><b>Total</td><td><b>"+m_total+"</td></tr>";
data=data+"<tbody></table>";
//alert(list);

document.getElementById("list1").innerHTML=data;//list['author'];
$(".loading_img").css({"display": "none"}); 




}


     })

}


/********Get Chargeable Jobs Project Wise***********************/

function chargeable_project(){

closeNav();

$(".loading_img").css({"display": "block"}); 
document.getElementById("list2").innerHTML="";//list['author'];
document.getElementById("list3").innerHTML="";
switch_val=document.Form1.switch_status.value;
testing_status=document.Form1.testing_status.value;

$.ajax({

type:'GET',
data:{chksql:"charge_project"},
url:"PHP/get_summary_chargeable.php",
success:function(result){

var list=JSON.parse(result);

var length=list.length;
		  data="<table class=\"table table-striped\" >";
		  data=data+"<thead>";
		  data=data+" <tr style=\"background-color:#69C7D6;\">";
		  data=data+" <th>Select</br><input type='checkbox' name='tick_all_mem'  onchange=\"tick_all('member')\" ></th>";
		  data=data+"<th>Project</th>";
		  data=data+" <th>Number of Issues</th>";
		  data=data+" <th>Chargeable Amount</th>";
		  data=data+" </tr>";
	      data=data+"</thead><tbody>";
		  
		  m_total=0;
		  m_total_amount=0;
for(i=0;i<length;i++){
data=data+"<tr id='record_row'><td><input class='user_list' type='checkbox' name='user_list[]' value='"+list[i].id+"' onchange='charge_inv()'></td><td>"+list[i].name+"</td><td>"+list[i].number_issues+"</td><td>"+Number(list[i].charge_amount).toLocaleString()+"</td></tr>";
m_total=m_total+Number(list[i].number_issues);
m_total_amount=m_total_amount+Number(list[i].charge_amount);
//data=data+list[i]+"</br>";

}
data=data+"<tr id='record_total'><td> &nbsp </td><td><b>Total</td><td><b>"+m_total+"</td><td><b>"+Number(m_total_amount).toLocaleString()+"</td></tr>";
data=data+"<tbody></table>";
//alert(list);

document.getElementById("list1").innerHTML=data;//list['author'];
$(".loading_img").css({"display": "none"}); 




}


     })

}

//////////////////////////////Sub Menu 1 Functions Start/////////////////////////////////
/**************************************Get Project Wise Issues Of Members***********************************/

function project_pending(){

 /*var favorite = [];
            $.each($("input[name='sport']:checked"), function(){            
                favorite.push($(this).val());*/
$(".loading_img").css({"display": "block"}); 
switch_val=document.Form1.switch_status.value;
//alert('reached');		
				
document.getElementById("list3").innerHTML="";				
				
var selected_members=[];
$.each($("input[name='user_list[]']:checked"), function(){            
                selected_members.push($(this).val())
				});
				
if	(selected_members.length>0){			
				//alert( selected_members.join(", "));
$.ajax({

type:'GET',
data:{chksql:"projects",members:JSON.stringify(selected_members),switch_val:switch_val},
url:"PHP/get_summary.php",
success:function(result){

var list=JSON.parse(result);

var length=list.length;

		  data="<table class=\"table table-striped\" >";
		  data=data+"<thead>";
		  data=data+" <tr style=\"background-color:#69C7D6;\">";
		  data=data+" <th>Select</br><input type='checkbox' name='tick_all_pro'  onchange=\"tick_all('project')\"  ></th>";
		  data=data+"<th>Assigned to</th>";
		  data=data+" <th>Number of Issues</th>";
		  data=data+" </tr>";
	      data=data+"</thead><tbody>";
		  
		  m_total=0;
		  
for(i=0;i<length;i++){
data=data+"<tr id='record_row'><td><input type='checkbox' name='project_list[]' value='"+list[i].id+"' onchange='issue_detail()'></td><td>"+list[i].name+"</td><td>"+list[i].number_issues+"</td></tr>";
//data=data+list[i]+"</br>";
m_total=m_total+Number(list[i].number_issues);
}
data=data+"<tr id='record_total'><td> &nbsp </td><td><b>Total</td><td><b>"+m_total+"</td></tr>";
data=data+"<tbody></table>";
//alert(list);

document.getElementById("list2").innerHTML=data;//list['author'];
$(".loading_img").css({"display": "none"}); 

//get_graph(list);

}


     })}else{
	 
	 document.getElementById("list2").innerHTML="";
	 $(".loading_img").css({"display": "none"}); 

	 }


}
/**************************************Get Tracker Wise Issues Of Projects***********************************/

function tracker_pending(){

 /*var favorite = [];
            $.each($("input[name='sport']:checked"), function(){            
                favorite.push($(this).val());*/
				
testing_status=document.Form1.testing_status.value;
				
$(".loading_img").css({"display": "block"}); 
switch_val=document.Form1.switch_status.value;
//alert('reached');		
				
document.getElementById("list3").innerHTML="";				
				
var selected_projects=[];
$.each($("input[name='user_list[]']:checked"), function(){            
                selected_projects.push($(this).val())
				});
				
if	(selected_projects.length>0){			
				//alert( selected_members.join(", "));
$.ajax({

type:'GET',
data:{chksql:"tracker",projects:JSON.stringify(selected_projects),switch_val:switch_val,testing_status:testing_status},
url:"PHP/get_summary.php",
success:function(result){

var list=JSON.parse(result);

var length=list.length;

		  data="<table class=\"table table-striped\" >";
		  data=data+"<thead>";
		  data=data+" <tr style=\"background-color:#69C7D6;\">";
		  data=data+" <th>Select</br><input type='checkbox' name='tick_all_pro'  onchange=\"tick_all('project')\"  ></th>";
		  data=data+"<th>Assigned to</th>";
		  data=data+" <th>Number of Issues</th>";
		  data=data+" </tr>";
	      data=data+"</thead><tbody>";
		  
		  m_total=0;
		  
for(i=0;i<length;i++){
data=data+"<tr id='record_row'><td><input type='checkbox' name='project_list[]' value='"+list[i].id+"' onchange='issue_detail_tracker()'></td><td>"+list[i].name+"</td><td>"+list[i].number_issues+"</td></tr>";
//data=data+list[i]+"</br>";
m_total=m_total+Number(list[i].number_issues);
}
data=data+"<tr id='record_total'><td> &nbsp </td><td><b>Total</td><td><b>"+m_total+"</td></tr>";
data=data+"<tbody></table>";
//alert(list);

document.getElementById("list2").innerHTML=data;//list['author'];
$(".loading_img").css({"display": "none"}); 

//get_graph(list);

}


     })}else{
	 
	 document.getElementById("list2").innerHTML="";
	 $(".loading_img").css({"display": "none"}); 

	 }


}


/**************************************Get Chargeble Status Wise Issues Of Chargeable Job***********************************/

function charge_inv(){

 /*var favorite = [];
            $.each($("input[name='sport']:checked"), function(){            
                favorite.push($(this).val());*/
				
testing_status=document.Form1.testing_status.value;
				
$(".loading_img").css({"display": "block"}); 
switch_val=document.Form1.switch_status.value;
//alert('reached');		
				
document.getElementById("list3").innerHTML="";				
				
var selected_projects=[];
$.each($("input[name='user_list[]']:checked"), function(){            
                selected_projects.push($(this).val())
				});
				
if	(selected_projects.length>0){			
				//alert( selected_members.join(", "));
$.ajax({

type:'GET',
data:{chksql:"charge_status",projects:JSON.stringify(selected_projects),switch_val:switch_val,testing_status:testing_status},
url:"PHP/get_summary_chargeable.php",
success:function(result){

var list=JSON.parse(result);

var length=list.length;

		  data="<table class=\"table table-striped\" >";
		  data=data+"<thead>";
		  data=data+" <tr style=\"background-color:#69C7D6;\">";
		  data=data+" <th>Select</br><input type='checkbox' name='tick_all_pro'  onchange=\"tick_all('project')\"  ></th>";
		  data=data+"<th>Assigned to</th>";
		  data=data+" <th>Number of Issues</th>";
		  data=data+" <th>Chargeable Amount</th>";
		  data=data+" </tr>";
	      data=data+"</thead><tbody>";
		  
		  m_total=0;
		  
  m_total=0;
  m_total_amount=0;
  
for(i=0;i<length;i++){
data=data+"<tr id='record_row'><td><input class='user_list' type='checkbox' name='user_list[]' value='"+list[i].id+"' onchange='tracker_pending()'></td><td>"+list[i].name+"</td><td>"+list[i].number_issues+"</td><td>"+Number(list[i].charge_amount).toLocaleString()+"</td></tr>";
m_total=m_total+Number(list[i].number_issues);
m_total_amount=m_total_amount+Number(list[i].charge_amount);
//data=data+list[i]+"</br>";

}
data=data+"<tr id='record_total'><td> &nbsp </td><td><b>Total</td><td><b>"+m_total+"</td><td><b>"+Number(m_total_amount).toLocaleString()+"</td></tr>";
data=data+"<tbody></table>";
//alert(list);

document.getElementById("list2").innerHTML=data;//list['author'];
$(".loading_img").css({"display": "none"}); 

//get_graph(list);

}


     })}else{
	 
	 document.getElementById("list2").innerHTML="";
	 $(".loading_img").css({"display": "none"}); 

	 }


}
//////////////////////////////Sub Menu 2 Functions Start/////////////////////////////////
/**************************************Get Issue Detail Project Wise***********************************/

function issue_detail(){

/*var favorite = [];
            $.each($("input[name='sport']:checked"), function(){            
                favorite.push($(this).val());*/
				

$(".loading_img").css({"display": "block"}); 
switch_val=document.Form1.switch_status.value;		
				
var selected_members=[];
$.each($("input[name='user_list[]']:checked"), function(){            
                selected_members.push($(this).val())
				});
				
var selected_projects=[];
$.each($("input[name='project_list[]']:checked"), function(){            
                selected_projects.push($(this).val())
				});
			//	alert(selected_projects.length);
if	(selected_projects.length>0){			
				//alert( selected_members.join(", "));
$.ajax({

type:'GET',
data:{chksql:"issue_detail",members:JSON.stringify(selected_members),projects:JSON.stringify(selected_projects),switch_val:switch_val},
url:"PHP/get_summary.php",
success:function(result){


var list=JSON.parse(result);

var length=list.length;

		  data="<table class=\"table table-striped\" >";
		  data=data+"<thead>";
		  data=data+" <tr style=\"background-color:#69C7D6;\">";
		  data=data+" <th>ID</th>";
		  data=data+" <th>Project</th>";
		  data=data+" <th>Tracker</th>";
		  data=data+" <th>Status</th>";
		  data=data+" <th>Subject</th>";
		  data=data+" <th>Description</th>";
		  data=data+" <th>Assigned to </th>";
		  data=data+" <th>Start Date</th>";
		  data=data+" <th>Due Date</th>";
		  data=data+" <th>Done Ratio</th>";
		  data=data+" </tr>";
	      data=data+"</thead><tbody>";
for(i=0;i<length;i++){
data=data+"<tr id='record_row' ><td><a onclick='link_redmine(\""+list[i].id+"\")'  style{cursor:auto;}>"+list[i].id+"</a></td>";
data=data+"<td>"+list[i].project+"</td>";
data=data+"<td>"+list[i].tracker+"</td>";
data=data+"<td>"+list[i].status+"</td>";
data=data+"<td>"+list[i].subject+"</td>";
data=data+"<td>"+list[i].description+"</td>";
data=data+"<td>"+list[i].assigned_to+"</td>";
data=data+"<td>"+list[i].start_date+"</td>";
data=data+"<td>"+list[i].due_date+"</td>";
data=data+"<td>"+list[i].done_ratio+"</td></tr>";

//data=data+list[i]+"</br>";

}
data=data+"<tbody></table>";
//alert(list);

document.getElementById("list3").innerHTML=data;//list['author'];
//get_graph(list);
$(".loading_img").css({"display": "none"}); 

}


     })}else{
	 
	 document.getElementById("list3").innerHTML="";
	 $(".loading_img").css({"display": "none"}); 
	 }


}

/**************************************Get Issue Detail Tracker Wise***********************************/

function issue_detail_tracker(){

/*var favorite = [];
            $.each($("input[name='sport']:checked"), function(){            
                favorite.push($(this).val());*/
				
testing_status=document.Form1.testing_status.value;

$(".loading_img").css({"display": "block"}); 
switch_val=document.Form1.switch_status.value;		
				
var selected_projects=[];
$.each($("input[name='user_list[]']:checked"), function(){            
                selected_projects.push($(this).val())
				});
				
var selected_trackers=[];
$.each($("input[name='project_list[]']:checked"), function(){            
                selected_trackers.push($(this).val())
				});
			//	alert(selected_projects.length);
if	(selected_trackers.length>0){			
				//alert( selected_members.join(", "));
$.ajax({

type:'GET',
data:{chksql:"issue_detail_tracker",project:JSON.stringify(selected_projects),tracker:JSON.stringify(selected_trackers),switch_val:switch_val,testing_status:testing_status},
url:"PHP/get_summary.php",
success:function(result){


var list=JSON.parse(result);

var length=list.length;

		  data="<table class=\"table table-striped\" >";
		  data=data+"<thead>";
		  data=data+" <tr style=\"background-color:#69C7D6;\">";
		  data=data+" <th>ID</th>";
		  data=data+" <th>Project</th>";
		  data=data+" <th>Tracker</th>";
		  data=data+" <th>Status</th>";
		  data=data+" <th>Subject</th>";
		  data=data+" <th>Description</th>";
		  data=data+" <th>Assigned to </th>";
		  data=data+" <th>Start Date</th>";
		  data=data+" <th>Due Date</th>";
		  data=data+" <th>Done Ratio</th>";
		  data=data+" </tr>";
	      data=data+"</thead><tbody>";
for(i=0;i<length;i++){
data=data+"<tr id='record_row'><td><a onclick='link_redmine(\""+list[i].id+"\")'>"+list[i].id+"</a></td>";
data=data+"<td>"+list[i].project+"</td>";
data=data+"<td>"+list[i].tracker+"</td>";
data=data+"<td>"+list[i].status+"</td>";
data=data+"<td>"+list[i].subject+"</td>";
data=data+"<td>"+list[i].description+"</td>";
data=data+"<td>"+list[i].assigned_to+"</td>";
data=data+"<td>"+list[i].start_date+"</td>";
data=data+"<td>"+list[i].due_date+"</td>";
data=data+"<td>"+list[i].done_ratio+"</td></tr>";

//data=data+list[i]+"</br>";

}
data=data+"<tbody></table>";
//alert(list);

document.getElementById("list3").innerHTML=data;//list['author'];
//get_graph(list);
$(".loading_img").css({"display": "none"}); 

}


     })}else{
	 
	 document.getElementById("list3").innerHTML="";
	 $(".loading_img").css({"display": "none"}); 
	 }


}

/*function tick_all(val){

if(val=="member"){

  //"select all" change 
    var status = this.checked; // "select all" checked status
	$.each($("input[name='member_list']"), function(){            
                thi.checked=status;)
				});
   


}

}*/




function tick_all(val){

var screen_status=document.Form1.screen_status.value; 

if(val=='member'){
//"select all" change 
    var status = document.Form1.tick_all_mem.checked; // "select all" checked status
	//alert(status);
   $.each($("input[name='user_list[]']"), function(){            
                this.checked=status;
				
				});
				
				if(screen_status=='members'){
				project_pending();}
				else if(screen_status=='projects'){
				tracker_pending();
				}else if(screen_status=='testing'){
				tracker_pending();
				}else if(screen_status=='chargeable'){
				charge_inv();
				}
				
				
				
	}else if (val='project'){
	
var status = document.Form1.tick_all_pro.checked; // "select all" checked status
	//alert(status);
   $.each($("input[name='project_list[]']"), function(){            
                this.checked=status;
				
				});
				
				
				if(screen_status=='members'){
				issue_detail();}
				else if(screen_status=='projects'){
				issue_detail_tracker();}
				else if(screen_status=='testing'){
				issue_detail_tracker();}
				else if(screen_status=='chargeable'){
				issue_detail_tracker();}		
	}			
}

function swith_on(){
var switch_status = document.Form1.switch_100.checked; 
var screen_status=document.Form1.screen_status.value; 
//alert(screen_status);

if(switch_status){

//document.body.style.backgroundColor = "white";
document.Form1.switch_status.value='ON';

if(screen_status=='members'){
member_pending();}
else if(screen_status=='projects'){
project_pending_first();
}else if(screen_status=='testing'){
project_pending_first();
}

//project_pending();
//issue_detail();

}else{

//document.body.style.backgroundColor = "rgba(0,0,0,0.4)";

document.Form1.switch_status.value='OFF';

if(screen_status=='members'){
member_pending();}
else if(screen_status=='projects'){
project_pending_first();
}else if(screen_status=='testing'){
project_pending_first();
}


//project_pending();
//issue_detail();
}

}


function link_redmine(val){

m_url="http://snpdsrv:8556/redmine/issues/"+val;
window.open(m_url);

}
</script>


 </head>
<?php require 'PHP/Menu.php';menu('srf_email'); ?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>



<?php require 'PHP/side_menu.php';?>
<body>
<form name="Form1">
<input type='hidden' name='nav_status' value="close">
<input type='hidden' name='switch_status' value="OFF">
<input type='hidden' name='screen_status' value="">
<input type='hidden' name='testing_status' value="">
<div class="container-fluid">

<div id="main">
 <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
 
  <div>
<img class='loading_img' src='images/loading.gif'>
</div>
 

  <div id='switch'>
 <label class="switch">
  <input type="checkbox" onchange="swith_on()" name='switch_100' >
  <div class="slider round"></div>
</label>
 </div>
 
 
 <div  align='left'  class='row'> 
 <div class='col-sm-1'> &nbsp </div>
<div class='col-sm-4'>
 <div id='list1'></div>
 </div>
 <div class='col-sm-1'> &nbsp </div>
  <div class='col-sm-4'> <div id='list2'></div></div>
   <div class='col-sm-3'> &nbsp </div>
 </div>
 
 
  <div  align='left'  class='row'> 
<div class='col-sm-12'>
 <div id='list3'></div>
 </div>

 </div>
 


 
</div>
</div>
</form>



</body>




</html>