<?php

function menu($screen){



echo '<nav class="navbar navbar-inverse">
     <div class="container-fluid">
     <div class="navbar-header">
	 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">Redmine Plan</a>
    </div>
	<div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li ><a href="index.php"  >Consolidated Plan Upload</a></li>
      <li><a href="Work_Plan.php">Daily Email</a></li>
	   <li><a href="Pending_Issue.php">Issue Analysis</a></li>
	   <li><a href="Dashboard.php">Dashboard</a></li>
	   <li><a href="Create_chat.php">Chat</a></li>
      <li><a href="SRF_Plan.php">SRF Upload</a></li>
      <li  class="dropdown">
	  <a class="dropdown-toggle" data-toggle="dropdown" href="#">SRF Plan<span class="caret"></span></a>
	  <ul class="dropdown-menu">
          <li><a href="Srf_Email.php">SRF Email</a></li>
		  <li><a href="Project_Wise.php">Project Wise Analysis</a></li>
          <li><a href="Company_Wise.php">Company Wise Analysis</a></li>
          <li><a href="Issue_Clarification.php">Issue Clarification</a></li>
           <li><a href="#">Chargeable Job Analysis</a></li> 		  
        </ul>
	  </li>
    </ul>
    </div>
	</div>
    </nav>';
	
	
     
}



?>
