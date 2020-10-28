<?php
	session_start();
	include("functions/db.php");
	include("functions/functions.php");
	
	$check_for_error = 0;
	$user_email = $_SESSION['email'];

	$user_details_sql = "SELECT id,first_name,last_name FROM users WHERE email = '$user_email'";

	$user_details_result = query($user_details_sql);
	$reported_by_username = null;
	foreach ($user_details_result as $temp) {
		$reported_by_userid = $temp['id'];
		$reported_by_username = $temp['first_name']." ".$temp['last_name'];
	}	
	$report_file_type = null;
	$report_file_id = null;
	$report_file_name = null;
	$report_to_userid = null;
	if(isset($_SESSION["report_file_id"]) && isset($_SESSION["report_file_type"]) && isset($_SESSION["report_file_name"]) && isset($_SESSION["report_to_userid"]))
	{
		$report_file_id =  $_SESSION["report_file_id"];
		unset($_SESSION['report_file_id']);
		$report_file_type = $_SESSION["report_file_type"];
		unset($_SESSION['report_file_type']);
		$report_file_name = $_SESSION["report_file_name"];
		unset($_SESSION['report_file_name']);
		$report_to_userid = $_SESSION["report_to_userid"];
		unset($_SESSION['report_to_userid']);
	//	echo $report_file_id." - ".$report_file_type." - ".$report_file_name." - ".$report_to_userid;
	}

	$report_reason = null;
	$report_description = null;
	if(isset($_POST['report_reason']))
	{
	$report_reason = $_POST['report_reason'];
	if($report_reason == 'Other')	$report_reason = $_POST['other_report'];
	}

	if(isset($_POST['report_description']))			$report_description = $_POST['report_description'];
		$insert_report_files = "INSERT INTO report_files(report_to_userid,report_file_name,report_file_type,report_file_id,report_reason,report_description,report_date,reported_by_userid) 
		VALUES('$report_to_userid','$report_file_name','$report_file_type','$report_file_id','$report_reason','$report_description',CURDATE(),'$reported_by_userid')";
		if($con->query($insert_report_files)===TRUE){
			$report_id = $con->insert_id;
		}
		else{
			$check_for_error = 1;
			set_message("Something Went Wrong...File is not Reported...Please try Again...");
			echo $con->error;
		}
	

		if($check_for_error == 1)
		{
			echo "<script type='text/javascript'>";
			echo "document.location.href = 'javascript:history.go(-1)' ";
			echo "</script>";
		}	
		else if($check_for_error == 0)
		{
			set_message("File is Reported successfully....Our Moderators will moderate file.");
			create_notification($report_to_userid,'Report',$reported_by_username.' Reported your file \"'.$report_file_name.'\"','reported_file_details.php?report_id='.$report_id);
			echo "<script type='text/javascript'>";
			echo "document.location.href = 'notes.php' ";
			echo "</script>";
		}
?>