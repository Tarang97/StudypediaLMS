<?php

	session_start();
	include("functions/db.php");
	include("functions/functions.php");
	
	$check_for_error = 0;
	$user_email = $_SESSION['email'];

	$first_name = null;
	$last_name = null;
	$email = null;
	$password = null;

	if(isset($_POST['first_name']))	$first_name = $_POST['first_name'];
	if(isset($_POST['last_name']))	$last_name = $_POST['last_name'];
	if(isset($_POST['email']))	$email = $_POST['email'];
	if(isset($_POST['password']))	$password = md5($_POST['password']);

	$update_users = "UPDATE users SET first_name = '$first_name',last_name = '$last_name',email = '$email',password = '$password' WHERE email = '$user_email'";
		if($con->query($update_users)===TRUE){
			//nothing
		}
		else{
			$check_for_error = 1;
			set_message("Something Went Wrong...Profile is not updated...Please try Again...");
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
			set_message("Profile is Updated Successfully....");
			$_SESSION['email'] = $email;			//to update login email if email is updated
			echo "<script type='text/javascript'>";
			echo "document.location.href = 'viewprofile.php' ";
			echo "</script>";
		}
?>