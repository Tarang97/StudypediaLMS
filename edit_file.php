<?php include("includes/header.php") ?>
<?php include("includes/nav.php") ?>
<?php
	$user_email = $_SESSION['email'];

	$user_details_sql = "SELECT id FROM users WHERE email = '$user_email'";

	$user_details_result = query($user_details_sql);

	foreach ($user_details_result as $temp) {
		$user_id = $temp['id'];
	}

	$filetype = null;$file_id = null;
	if(isset($_REQUEST['filetype']))		$filetype = $_REQUEST['filetype']; 
	if(isset($_REQUEST['file_id']))		$file_id = $_REQUEST['file_id'];

	$uploaded_by_userid = 0;

	if($filetype == 'notes')
	{
		$result_notes = array();
		$sql = "SELECT * FROM notes where note_id = '$file_id' ";
		$result1 = query($sql);
		foreach ($result1 as $row) {
				$file_name = $row['title'];
				$notes_subject = $row['subject'];
				$notes_field = $row['field'];
				$topics = $row['topics'];
				$file_path = $row['file_path'];
				$description = $row['description'];
				$uploaded_by_userid = $row['uploaded_by_userid'];
		}
	}
	elseif($filetype == 'cem')
	{
		$result_cem = array();
		$sql = "SELECT * FROM competitive_exam where cem_id = '$file_id' ";
		$result1 = query($sql);
		foreach ($result1 as $row) {
				$file_name = $row['cem_name'];
				$cem_authors = $row['cem_authors'];
				$cem_exams = $row['cem_exams'];
				$topics = $row['cem_topics'];
				$file_path = $row['cem_file_path'];
				$description = $row['cem_description'];
				$uploaded_by_userid = $row['cem_uploaded_by_userid'];	
		}
	}
?>
<html>
<head>
<title>Studypedia | Edit File</title>
<script src="js/jquery.js"></script>
<script src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
	//This function is for select an exams checkbox whichever written in database
	function CheckExams(){
		var exams = document.getElementsByClassName("exam_in_cem");//get all chechboxes			
		var exams_from_db = document.getElementById("exams_from_db");//get data from hidden paragraph tag which has value of exams which is taken from db
		var exams_from_db_str = exams_from_db.innerHTML;
		for(i=0;i<exams.length;i++)
		{
			if(exams_from_db_str.includes(exams[i].value))
			{
					exams[i].checked = "checked";						//chech checkbox if value of checkbox is in string of exams
			}
		}
	}
</script>
</head>
<body onload="CheckExams()">
	<!-- This hidden paragraph is used in javascript to check checkboxes of exams -->
	<p id="exams_from_db" style='display: none;'><?php if($filetype =='cem' && isset($cem_exams)) echo $cem_exams; ?></p>
	
  <div class="container">
  	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			
			<?php display_message(); ?>

			<?php validate_user_login(); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
			<h2>Edit File</h2>
			</div>
		</div>
	</div>
	  	<?php if(logged_in() && $uploaded_by_userid == $user_id):?>
	<div class="row">
		<div class='panel panel-default'>
		 <div class='panel-body'>
		 <form name="EditFileForm" id="EditFileForm" action="<?php echo 'edit_file_process.php?filetype='.$filetype.'&file_id='.$file_id; ?>" method="post" enctype="multipart/form-data">
		 <table class='table table-responsive'>
         <tbody>
		 <tr>
		 	<td>File Title<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
					<input type="text" name="file_name" id="file_name" tabindex="1" class="form-control"  maxlength="50" required="required" value="<?php echo $file_name; ?>">
					<span class="help-block">Maximum 50 characters</span>
					</div>
			</td>
		 </tr>
		 <tr>
		 	<td>Download File<sup style="color:red;">*</sup></td>
		 	<td>
		 	<a target='_blank' href='<?php echo $file_path; ?>'><button class='btn btn-primary' type='button'>Download</button></a>
		 	<span class="help-block">You cannot change file if you have another file then upload new file.</span>
      		</td>
		 </tr>
		 <?php if($filetype == 'notes'): ?>
		 <tr>
		 	<td>Subject<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
				<input type="text" name="subject_notes" id="subject_notes" tabindex="1" class="form-control"  maxlength="50"  required="required"  value="<?php echo $notes_subject; ?>">
					<span class="help-block">Maximum 50 characters</span>
					</div>
			</td>
		 </tr>
		 <?php else: ?>
		 <tr>
		 	<td>Material Authors<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
				<input type="text" name="authors_cem" id="authors_cem" tabindex="1" class="form-control"  maxlength="50"  required="required"  value="<?php echo $cem_authors; ?>">
					<span class="help-block">Write Authors who created this material</span>
					</div>
			</td>
		 </tr>
		 <?php endif; ?>
		 <?php if($filetype == 'notes'): ?>
		 <tr>
		 	<td>Education Field<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
				<input type="text" name="education_field_notes" id="education_field_notes" tabindex="1" class="form-control"  maxlength="50"  required="required"  value="<?php echo $notes_field; ?>">
					<span class="help-block">Write Education Field related to this file ex.CE,IT,MCA,B.com etc.(Maximum 50 characters)</span>
					</div>
			</td>
		 </tr>
		 <?php else: ?>
		 	<tr>
		 	<td>Useful In Exam<sup style="color:red;">*</sup></td>
		 	<td>
		 		<div class="form-group">
		 			<?php 
              		$fetch_cem_category = "SELECT * FROM cem_category";
              		$cem_category = query($fetch_cem_category);
              		foreach ($cem_category as $category) {
              			echo "<label class='checkbox-inline'><input type='checkbox' name='exam_in_cem[]' class='exam_in_cem' value='".strtoupper($category['category_name'])."'>".strtoupper($category['category_name'])."</label>";
              		}
              		?>
			<span id="exam_in_cem_error"></span>
			<span class="help-block">Select Exams in which this file can be used for preparation</span>
		</div>
		 	</td>
		 </tr>
		 <?php endif; ?>
		 <tr>
		 	<td>Topics<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
				<input type="text" name="topics" id="topics" tabindex="1" class="form-control"  maxlength="50"  required="required"  value="<?php echo $topics; ?>">
					<span class="help-block">Write topics covered in this file.(Maximum 50 characters)</span>
					</div>
			</td>
		 </tr>
		 <tr>
		 	<td>Description<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
  			<textarea class="form-control" rows="3" id="description" name="description" maxlength="250"  required="required"><?php echo $description; ?></textarea>
        <span class="help-block">Write other description about file like file type or file content,so other users can understand about file easily.(Maximum 250 characters)</span>
		</div></td>
		 </tr>
		 <tr>
		 	<td colspan="2" style="text-align: center;">
		 		<input type="submit" name="" id="btnEditFile" class="btn btn-info" value="Update">
		 		<input type="reset" name="" id="" class="btn btn-warning" value="Reset">
		 	</td>
		 </tr>
		 </tbody>
		 </table>
		 </form>
		 </div>
		 </div>
	</div>
	<?php endif; ?>

	<?php if(logged_in() == false): ?>
	<?php redirect("403.php"); ?>
	<!--div class="row">
		<div class="jumbotron">
		<a href='login.php'>Login</a> to Edit File
		</div>
	</div-->
	<?php endif; ?>

	<?php if($uploaded_by_userid != $user_id): ?>
	<div class="row">
		<div class="jumbotron">
		It's look like you have not uploaded this file.
		</div>
	</div>
	<?php endif; ?>
  </div>
  </body>
  </html>
  <?php include("includes/footer.php") ?>