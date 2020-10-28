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

		if(isset($_REQUEST['report_id'])){
			$report_id = $_REQUEST['report_id'];

			$get_filedetails_sql = "SELECT report_to_userid,report_file_name FROM report_files WHERE report_id = '$report_id'";
			$get_filedetails_result = query($get_filedetails_sql);
			$report_file_name = null;$notification_to_userid=null;
			foreach ($get_filedetails_result as $temp) {
				$notification_to_userid = $temp['report_to_userid'];
				$report_file_name=$temp['report_file_name'];
			}
			$update_report_query = "UPDATE report_files SET report_stage = 'File is OK',moderated_by_userid = '$user_id',moderated_on = CURDATE() where report_id = '$report_id'";

				if($con->query($update_report_query)===TRUE){
					set_message("File is removed from Reported Files.");
					create_notification($notification_to_userid,'Report_no_change','Your Reported file \"'.$report_file_name.'\" has been approved by our moderator '.$moderator_user_name.' and will not be deleted.','viewprofile.php');
					echo "<script type='text/javascript'>";
					echo "document.location.href = 'reported_files.php' ";
					echo "</script>";
					}
					else
					{
						set_message("File is not removed from Reported Files,Some error occured...");
						echo "<script type='text/javascript'>";
						echo "document.location.href = 'reported_files.php' ";
						echo "</script>";	
					}
				}	
		else
		{
			set_message("Something Went Wrong...File is not removed from Reported Files...Please try Again...");
			echo "<script type='text/javascript'>";
				echo "document.location.href = 'javascript:history.go(-1)' ";
				echo "</script>";
		}
?>