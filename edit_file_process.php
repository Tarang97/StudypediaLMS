<?php

	session_start();
	include("functions/db.php");
	include("functions/functions.php");
	
	$check_for_error = 0;
	$user_email = $_SESSION['email'];

	$filetype = null;
	$file_id = null;

	if(isset($_REQUEST['filetype']))		$filetype = $_REQUEST['filetype'];
	if(isset($_REQUEST['file_id']))			$file_id = $_REQUEST['file_id'];
	$file_name = null;
	$notes_subject = null;
	$notes_field = null;
	$topics = null;
	$description = null;
	$cem_authors = null;
	$cem_exams = null;

	if($filetype == 'notes')
	{
		$file_name = $_POST['file_name'];
		$notes_subject = $_POST['subject_notes'];
		$notes_field = $_POST['education_field_notes'];
		$topics = $_POST['topics'];
		$description = $_POST['description'];
		$edit_file_query = "UPDATE notes SET title = '$file_name',subject = '$notes_subject',field = '$notes_field',topics = '$topics',description = '$description' WHERE note_id = '$file_id'";
	}
	elseif($filetype == 'cem')
	{
		$file_name = $_POST['file_name'];
		$cem_authors = $_POST['authors_cem'];
		if(!empty($_POST['exam_in_cem']))
		{
		$temp_exam = $_POST['exam_in_cem'];
		$cem_exams = implode(",", $temp_exam);
		}
		$topics = $_POST['topics'];
		$description = $_POST['description'];
		$edit_file_query = "UPDATE competitive_exam SET cem_name = '$file_name',cem_authors = '$cem_authors',cem_exams = '$cem_exams',cem_topics = '$topics',cem_description = '$description' WHERE cem_id = '$file_id'";
	}

	
		if($con->query($edit_file_query)===TRUE){
			//nothing
		}
		else{
			$check_for_error = 1;
			set_message("Something Went Wrong...File is not updated...Please try Again...");
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
			set_message("File is Updated Successfully....");
			echo "<script type='text/javascript'>";
			echo "document.location.href = 'viewprofile.php' ";
			echo "</script>";
		}
?>