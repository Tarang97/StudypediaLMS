<?php
	session_start();
	include("functions/db.php");
	include("functions/functions.php");
	
	$check_for_error = 0;
	$user_email = $_SESSION['email'];

	$user_details_sql = "SELECT id,first_name,last_name FROM users WHERE email = '$user_email'";

	$user_details_result = query($user_details_sql);

	foreach ($user_details_result as $temp) {
		$suggested_by_userid = $temp['id'];
		$suggested_by_username = $temp['first_name']." ".$temp['last_name'];
	}	
	
	$suggestion_file_type = null;
	$suggestion_file_id = null;
	$suggestion_file_name = null;
	$suggestion_to_userid = null;
	if($_REQUEST['suggestion_details'] != null)
	{
		$suggestion_details = explode("-",$_REQUEST['suggestion_details']);
		print_r($suggestion_details);
		$suggestion_file_id = $suggestion_details[0];
		$suggestion_file_type = $suggestion_details[1];
		$suggestion_file_name = $suggestion_details[2];
		$suggestion_to_userid = $suggestion_details[3];
	}
		echo $suggestion_file_id." - ".$suggestion_file_type." - ".$suggestion_file_name." - ".$suggestion_to_userid;

	$suggestion_edit_in = null;
	$suggestion_description = null;
	if(isset($_POST['suggestion_edit_in']))	$suggestion_edit_in = $_POST['suggestion_edit_in'];

	if(isset($_POST['suggestion_description']))			$suggestion_description = $_POST['suggestion_description'];
		$insert_suggestedits = "INSERT INTO suggestedits(suggestion_to_userid,suggestion_file_name,suggestion_file_type,suggestion_file_id,suggestion_edit_in, suggestion_description,suggested_by_userid,suggested_on) 
		VALUES('$suggestion_to_userid','$suggestion_file_name','$suggestion_file_type','$suggestion_file_id','$suggestion_edit_in','$suggestion_description','$suggested_by_userid',CURDATE())";
		if($con->query($insert_suggestedits)===TRUE){
			$suggestion_id = $con->insert_id;
		}
		else{
			$check_for_error = 1;
			set_message(" Something Went Wrong...Suggestion is not submitted...Please try Again...");
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
			set_message("Suggestion is submitted successfully....");
			create_notification($suggestion_to_userid,'Suggest Edit',$suggested_by_username.' Suggested one suggestion for your file \"'.$suggestion_file_name.'\"','suggestedits_file_details.php?suggestion_id='.$suggestion_id);
			echo "<script type='text/javascript'>";
			echo "document.location.href = 'notes.php' ";
			echo "</script>";
		}
?>