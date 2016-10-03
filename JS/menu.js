function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
	document.getElementById("mySidenav").style.marginTop = "50px";
    document.getElementById("main").style.marginLeft = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
	
      $("#list1").hide();
	  $("#list2").hide();
	  $("#list3").hide();
	
	chk_status=document.Form1.nav_status.value;
	if(chk_status=='close'){
	document.Form1.nav_status.value="open";}
	else{
	closeNav();
	}
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.body.style.backgroundColor = "white";
	//document.Form1.nav_status.value="close";
	
	document.Form1.nav_status.value="close";
	
	
	$("#list1").show();
	$("#list2").show();
	$("#list3").show();
	
	
}