<?php
	session_start();
	include("functions/db.php");
	include("functions/functions.php");

	$user_email = $_SESSION['email'];

	$user_details_sql = "SELECT id,first_name,last_name FROM users WHERE email = '$user_email'";

	$user_details_result = query($user_details_sql);
	$moderator_user_name = null;
	foreach ($user_details_result as $temp) {
		$user_id = $temp['id'];
		$moderator_user_name = $temp['first_name']." ".$temp['last_name'];
	}

	if(isset($_REQUEST['filetype']) && $_REQUEST['filetype'] == 'notes')
	{
		if(isset($_REQUEST['note_id']) && isset($_REQUEST['file_path']) && isset($_REQUEST['report_id']) && isset($_REQUEST['report_file_id'])){
		$note_id = $_REQUEST['note_id'];
		$file_path = $_REQUEST['file_path'];
		$report_id = $_REQUEST['report_id'];
		$report_file_id = $_REQUEST['report_file_id'];
		$update_report_query = "UPDATE report_files SET report_stage = 'File Deleted',moderated_by_userid = '$user_id',moderated_on = CURDATE() where report_id = '$report_id' OR report_file_id = '$report_file_id' ";

		if($con->query($update_report_query)===TRUE){
			$get_filedetails_sql = "SELECT title,uploaded_by_userid FROM notes WHERE note_id = '$report_file_id'";
			$get_filedetails_result = query($get_filedetails_sql);
			$file_name=null;$notification_to_userid=null;
			foreach ($get_filedetails_result as $temp) {
				$file_name = $temp['title'];
				$notification_to_userid = $temp['uploaded_by_userid'];
			}
			$delete_note_query = "DELETE FROM notes where note_id = '$note_id' ";	
			if($con->query($delete_note_query) == TRUE)
			{
			set_message("File and its details are successfully deleted and File is removed from Reported Files.");
			create_notification($notification_to_userid,'Delete File',$moderator_user_name.' Deleted your file \"'.$file_name.'\" due to report','viewprofile.php');
			echo "<script type='text/javascript'>";
			echo "document.location.href = 'reported_files.php' ";
			echo "</script>";
			}
			else
			{
				set_message("File is not removed from Reported Files but File is not deleted,Some error occured...");
				echo "<script type='text/javascript'>";
				echo "document.location.href = 'reported_files.php' ";
				echo "</script>";	
			}
			// $fh = fopen($file_path, 'a');
			// unlink($file_path);
		}
		else{
			// echo "Failed";
			set_message("Something Went Wrong...File and details are not deleted...Please try Again...");
			echo "<script type='text/javascript'>";
			echo "document.location.href = 'javascript:history.go(-1)' ";
			echo "</script>";
		}
		}	
		else
		{
		set_message("Something Went Wrong...File and details are not deleted...Please try Again...");
		echo "<script type='text/javascript'>";
			echo "document.location.href = 'javascript:history.go(-1)' ";
			echo "</script>";
		}
	}
	elseif(isset($_REQUEST['filetype']) && $_REQUEST['filetype'] == 'cem')
	{
		if(isset($_REQUEST['cem_id']) && isset($_REQUEST['cem_file_path']) && isset($_REQUEST['report_id']) && isset($_REQUEST['report_file_id'])){
		$cem_id = $_REQUEST['cem_id'];
		$cem_file_path = $_REQUEST['cem_file_path'];
		$report_id = $_REQUEST['report_id'];
		$report_file_id = $_REQUEST['report_file_id'];
		$update_report_query = "UPDATE report_files SET report_stage = 'File Deleted',moderated_by_userid = '$user_id',moderated_on = CURDATE() where report_id = '$report_id' OR report_file_id = '$report_file_id' ";

		if($con->query($update_report_query)===TRUE){
			$get_filedetails_sql = "SELECT cem_name,cem_uploaded_by_userid FROM competitive_exam WHERE cem_id = '$report_file_id'";
			$get_filedetails_result = query($get_filedetails_sql);
			$file_name=null;$notification_to_userid=null;
			foreach ($get_filedetails_result as $temp) {
				$file_name = $temp['cem_name'];
				$notification_to_userid = $temp['cem_uploaded_by_userid'];
			}
			$delete_cem_query = "DELETE FROM competitive_exam where cem_id = '$cem_id' ";	
			if($con->query($delete_cem_query) == TRUE)
			{
			set_message("File and its details are successfully deleted and File is removed from Reported Files.");
			create_notification($notification_to_userid,'Delete File',$moderator_user_name.' Deleted your file \"'.$file_name.'\" due to report','viewprofile.php');
			echo "<script type='text/javascript'>";
			echo "document.location.href = 'reported_files.php' ";
			echo "</script>";
			}
			else
			{
				set_message("File is not removed from Reported Files but File is not deleted,Some error occured...");
				echo "<script type='text/javascript'>";
				echo "document.location.href = 'reported_files.php' ";
				echo "</script>";	
			}
			// $fh = fopen($file_path, 'a');
			// unlink($file_path);
		}
		else{
			echo "Failed";
			set_message("Something Went Wrong...File and details are not deleted...Please try Again...");
			echo "<script type='text/javascript'>";
			echo "document.location.href = 'javascript:history.go(-1)' ";
			echo "</script>";
		}
		}	
		else
		{
		set_message("Something Went Wrong...File and details are not deleted...Please try Again...");
		echo "<script type='text/javascript'>";
			echo "document.location.href = 'javascript:history.go(-1)' ";
			echo "</script>";
		}
	}
?>