<?php

/** Set default timezone (will throw a notice otherwise) */
date_default_timezone_set('Asia/Kolkata');

include '../PHPExcel/IOFactory.php';

if(isset($_FILES['work_plan']['name'])){
		
	$file_name = $_FILES['work_plan']['name'];
	$file_name2=$_FILES['conso_plan']['name'];
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	$ext2 = pathinfo($file_name2, PATHINFO_EXTENSION);
	
	//Checking the file extension
	if($ext == "xls" || $ext == "xlsx"){
		
		
			$file_name = $_FILES['work_plan']['tmp_name'];
			$inputFileName = $file_name;
			
			$file_name2 = $_FILES['conso_plan']['tmp_name'];
			$inputFileName2 = $file_name2;

		//  Read your Excel workbook
		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
			
			$inputFileType2 = PHPExcel_IOFactory::identify($inputFileName2);
			$objReader2 = PHPExcel_IOFactory::createReader($inputFileType2);
			$objPHPExcel2 = $objReader2->load($inputFileName2);
		} catch (Exception $e) {
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
			. '": ' . $e->getMessage());
		}

		//Table used to display the contents of the file
		//echo '<center><table style="width:50%;" border=1>';
		
		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		
		$sheet2 = $objPHPExcel2->getSheet(0);
		$highestRow2 = $sheet2->getHighestRow();
		$highestColumn2 = $sheet2->getHighestColumn();
		
		require 'connection.php';
		$sql="TRUNCATE TABLE temp_upload";
		$result=mysql_query($sql);
		$sql="TRUNCATE TABLE conso_plan";
		$result=mysql_query($sql);
		
		
                 
		//  Loop through each row of the worksheet in turn
		for ($row = 6; $row <= $highestRow; $row++) {
			//  Read a row of data into an array
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
			NULL, TRUE, FALSE);
			
			
			$count=0;
			//echoing every cell in the selected row for simplicity. You can save the data in database too.
			foreach($rowData[0] as $k=>$v){
				//echo "<td>".$v."</td>";
				
				if($count==1){
				$ref_no=$v;
				$sql="INSERT INTO temp_upload (`REF_NO`) VALUES ('".$v."')";
                $result=mysql_query($sql);
	            }else if($count==2){
				    $sql="  UPDATE temp_upload SET STATUS ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==3){
				    $sql="  UPDATE temp_upload SET PROJECT ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==4){
				    $sql="  UPDATE temp_upload SET TRACKER ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==6){
				    $sql="  UPDATE temp_upload SET SUBJECT ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==7){
				    $sql="  UPDATE temp_upload SET ASSIGNED_TO ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==8){
				    $sql="  UPDATE temp_upload SET START_DATE ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==9){
				    $sql="  UPDATE temp_upload SET DUE_DATE ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==10){
				    $sql="  UPDATE temp_upload SET PERCENTAGE_DONE ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}
				
				
				 $count++;
				 }
		    
		}
		
		
		
		
			//  Loop through each row of the worksheet in turn
		for ($row = 6; $row <= $highestRow2; $row++) {
			//  Read a row of data into an array
			$rowData = $sheet2->rangeToArray('A' . $row . ':' . $highestColumn2 . $row, 
			NULL, TRUE, FALSE);
			//echo "<tr>";
			
			$count=0;
			//echoing every cell in the selected row for simplicity. You can save the data in database too.
			foreach($rowData[0] as $k=>$v){
				//echo "<td>".$v."</td>";
				
				if($count==1){
				$ref_no=$v;
				$sql="INSERT INTO conso_plan (`REF_NO`) VALUES ('".$v."')";
                $result=mysql_query($sql);
	            }else if($count==2){
				    $sql="  UPDATE conso_plan SET STATUS ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==3){
				    $sql="  UPDATE conso_plan SET PROJECT ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==4){
				    $sql="  UPDATE conso_plan SET TRACKER ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==6){
				    $sql="  UPDATE conso_plan SET SUBJECT ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==7){
				    $sql="  UPDATE conso_plan SET ASSIGNED_TO ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==8){
				    $sql="  UPDATE conso_plan SET START_DATE ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==9){
				    $sql="  UPDATE conso_plan SET DUE_DATE ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}else if($count==10){
				    $sql="  UPDATE conso_plan SET PERCENTAGE_DONE ='".$v."' WHERE REF_NO='".$ref_no."'";
					$result=mysql_query($sql);
				}
				
				
				 $count++;
				 }
		    
		}
			//mysqli_close($conect);
		    header ("Location: ../Work_plan.php");
	}

	else{
		echo '<p style="color:red;">Please upload file with xlsx extension only</p>'; 
	}	
		
}
?>