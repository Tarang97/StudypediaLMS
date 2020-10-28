<?php include("includes/header.php"); ?>
  <?php include("includes/nav.php"); ?>
<?php
	//session_start();
	//include("functions/db.php");
//	include("functions/functions.php");
	
	$check_for_error = 0;
	$user_email = $_SESSION['email'];

	$user_details_sql = "SELECT id,first_name,last_name FROM users WHERE email = '$user_email'";

	$user_details_result = query($user_details_sql);

	foreach ($user_details_result as $temp) {
		$user_id = $temp['id'];
		$user = $temp['first_name']." ".$temp['last_name'];
	}

	$title_cem = $_POST['title_cem'];
	$authors_cem = $_POST['authors_cem'];
	$topics_cem = $_POST['topics_cem'];
	$description_cem = $_POST['description_cem'];
	$exam_in_cem = "";
	if(!empty($_POST['exam_in_cem']))
	{
	$temp_exam = $_POST['exam_in_cem'];
	$exam_in_cem = implode(",", $temp_exam);
	}

	if(logged_in())
	{
		$uploaded_file_path = null;
		$filename = null;
		$filetype = null;
		$filesize = null;
		if(isset($_FILES["file_cem"]["error"]))
		{
			if($_FILES["file_cem"]["error"]>0)											//if any error occured
			{
				set_message("Some Error occured....File is not uploaded...Please try again...");
				$check_for_error = 1;
			}
			else
			{		
			if(isset($_FILES["file_cem"]["name"])) 	$filename = $_FILES["file_cem"]["name"];
			if(isset($_FILES["file_cem"]["type"])) 	$filetype = $_FILES["file_cem"]["type"];
			if(isset($_FILES["file_cem"]["size"])) 	$filesize = $_FILES["file_cem"]["size"];
			if($filename != null)	$ext = pathinfo($filename,PATHINFO_EXTENSION);						//extension of file
			$maxsize = 20*1024*1024;								//20mb
			if($filename != null && $filetype != null && $filesize != null && isset($ext))
			{
				if($filesize<$maxsize)
				{
					if(file_exists("competitive_exam/".$_FILES["file_cem"]["name"]))				//if file of same is already exists
					{
					set_message("File is already exists...");
					$check_for_error = 1;
					}
					else
					{
					move_uploaded_file($_FILES["file_cem"]["tmp_name"],"competitive_exam/".$_FILES["file_cem"]["name"]);			
					//on upload file html file will store it to temporary directory this function is for move that file to given folder 
					$uploaded_file_path = "competitive_exam/".$_FILES["file_cem"]["name"];
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
		$insert_cem_details = "INSERT INTO competitive_exam(cem_name,cem_authors,cem_exams,cem_topics,cem_description,cem_uploaded_by_userid,cem_uploaded_by,cem_uploaded_on,cem_file_path) 
		VALUES('$title_cem','$authors_cem','$exam_in_cem','$topics_cem','$description_cem','$user_id','$user',CURDATE(),'$uploaded_file_path')";
		if($con->query($insert_cem_details)===TRUE){
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
	// 				echo "<div class='row'>
	// 	<div class='col-md-12'>
	// 		<div class='page-header'>
	// 		<h2>Upload Competitive Exam Material</h2>
	// 		</div>
	// 	</div>
	// </div>";
			echo "<center><div class='container'><img src='images/file_upload.gif' height='500px' width='300px'/></div></center>";
			//echo "<div class='container'><div class='jumbotron'><h4>File is Uploading......</h4> </div></div>";
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
			 echo "document.location.href = 'cem.php?cem_category=GRE' ";
			 echo "</script>";	
			//}
		}

?>
<?php //include("includes/footer.php") ?>