<?php

phpinfo();
exit();

 include("includes/header.php"); ?>
<?php include("includes/nav.php"); ?>
<?php
	// dl('php_imagick.dll');
	$check_for_error = 0;
	$user_email = $_SESSION['email'];

	$user_details_sql = "SELECT id,first_name,last_name FROM users WHERE email = '$user_email'";

	$user_details_result = query($user_details_sql);

	foreach ($user_details_result as $temp) {
		$user_id = $temp['id'];
		$user = $temp['first_name']." ".$temp['last_name'];
	}

	$file_title_notes = $_POST['file_title_notes'];
	$subject_notes = $_POST['subject_notes'];
	$education_field_notes = $_POST['education_field_notes'];
	$topics_notes = $_POST['topics_notes'];
	$description_notes = $_POST['description_notes'];
	$uploaded_file_path = null;
	$filename = null;
	$filetype = null;
	$filesize = null;
	if(logged_in())
	{
		if(isset($_FILES["file_notes"]["error"]))
		{
			if($_FILES["file_notes"]["error"]>0)											//if any error occured
			{
				set_message("Some Error occured....File is not uploaded...Please try again...");
				$check_for_error = 1;
			}
			else
			{		
			if(isset($_FILES["file_notes"]["name"])) 	$filename = $_FILES["file_notes"]["name"];
			if(isset($_FILES["file_notes"]["type"])) 	$filetype = $_FILES["file_notes"]["type"];
			if(isset($_FILES["file_notes"]["size"])) 	$filesize = $_FILES["file_notes"]["size"];
			if($filename != null)	$ext = pathinfo($filename,PATHINFO_EXTENSION);						//extension of file
			$maxsize = 20*1024*1024;								//20mb

			if($filename != null && $filetype != null && $filesize != null && isset($ext))
			{
				if($filesize<$maxsize)
				{
					if(file_exists("notes/".$_FILES["file_notes"]["name"]))				//if file of same is already exists
					{
					set_message("File is already exists...");
					$check_for_error = 1;
					}
					else
					{
					move_uploaded_file($_FILES["file_notes"]["tmp_name"],"notes/".$_FILES["file_notes"]["name"]);
					
					//on upload file html file will store it to temporary directory this function is for move that file to given folder 
					$uploaded_file_path = "notes/".$_FILES["file_notes"]["name"];
					}
				}
				else
				{
					set_message("File Size is greater than 20 MB...File is not uploaded");
					$check_for_error = 1;
				}
			}
			else
			{
				set_message("Error occured....File is not uploaded...Please try again...");
				$check_for_error = 1;
			}
			}
		}
		else
		{
					set_message("File is not uploaded...Please try again...");
					$check_for_error = 1;
		}
	}
	else
	{
		set_message("Looks like you are not logged in...File is not uploaded...Please try again...");
		$check_for_error = 1;
	}

	if($check_for_error == 0)
	{
		$insert_file_details = "INSERT INTO notes(title,uploaded_by_userid,user,date,subject,field,topics,file_path,description) 
		VALUES('$file_title_notes',$user_id,'$user',CURDATE(),'$subject_notes','$education_field_notes','$topics_notes','$uploaded_file_path','$description_notes')";
		if($con->query($insert_file_details)===TRUE){
			//nothing
		}
		else{
			$check_for_error = 1;
			set_message("Something Went Wrong...File is not uploaded...Please try Again...");
		}
	}

		if($check_for_error == 1)
		{
			echo "<script type='text/javascript'>";
			echo "document.location.href = 'javascript:history.go(-1)' ";
			echo "</script>";
		}	
		else if($check_for_error == 0)
		{
	// 		echo "<div class='row'>
	// 	<div class='col-md-12'>
	// 		<div class='page-header'>
	// 		<h2>Upload Notes</h2>
	// 		</div>
	// 	</div>
	// </div>";
			// echo "<div class='container'><div class='jumbotron'><h4>File is Uploading......</h4> </div></div>";
			echo "<center><div class='container'><img src='images/file_upload.gif' height='500px' width='300px'/></div></center>";
			include("includes/footer.php");
			set_message("File is uploaded successfully");
			//if($uploaded_file_path != null && $filetype == "application/pdf")
			//{
			//echo "<script type='text/javascript'>";
			//echo "document.location.href = 'watermark/add_watermark.php?filepath=$uploaded_file_path' ";
			//echo "</script>";
			//}
			//else
			//{
			echo "<script type='text/javascript'>";
			echo "document.location.href = 'notes.php' ";
			echo "</script>";	
			//}
		}
?>
<?php //include("includes/footer.php"); ?>