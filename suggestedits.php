<?php include("includes/header.php") ?>
  <?php include("includes/nav.php") ?>
<html>
<head>
<title>Suggest Edits</title>
</head>
<body>
<?php if(logged_in()):?>
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
			<h2>Suggest Edits to File Uploader</h2>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="jumbotron">
		If something is wrong with this file then Suggest Edits to File Uploader.We will notify your suggestion to File Uploader.
		</div>
	</div>
	<?php
		 			$filetype = $_REQUEST["file_type"];			//'notes' or 'cem'(Competitive Exam Material)
		 			$file_name = null;
		 			if(isset($_REQUEST["note_id"]))
		 			{
					$note_id = $_REQUEST["note_id"];
					$sql = "SELECT * FROM notes where note_id = '".$note_id."' ";
					$result1 = query($sql);
					$i = 1;
						foreach ($result1 as $temp) {
							if($i<=1)
							{
							$file_name = $temp['title'];
							$suggestion_result = $temp;				//use $suggest_edits_result for furthur use of suggested file
							$i++;
							}
						}
					}
					elseif(isset($_REQUEST["cem_id"]))
					{
					$cem_id = $_REQUEST["cem_id"];
					$sql = "SELECT * FROM competitive_exam where cem_id = '".$cem_id."' ";
					$result1 = query($sql);	
					$i = 1;
						foreach ($result1 as $temp) {
							if($i<=1)
							{
							$file_name = $temp['cem_name'];					
							$suggestion_result = $temp;				//use $suggest_edits_result for furthur use of suggested file
							$i++;
							}
						}
					}
			$suggestion_details = null;
			if(isset($suggestion_result['note_id']))
		 	{
		 		$suggestion_details = $suggestion_result['note_id']."-"."notes"."-".$suggestion_result['title']."-".$suggestion_result['uploaded_by_userid'];
		 	}
		 	elseif (isset($suggestion_result['cem_id'])) {
		 		$suggestion_details = $suggestion_result['cem_id']."-"."cem"."-".$suggestion_result['cem_name']."-".$suggestion_result['cem_uploaded_by_userid'];
		 	}
			?>
	<div class="row">
		<div class='panel panel-default'>
		 <div class='panel-body'>
		 <form name="SuggestEditsForm" id="SuggestEditsForm" action="<?php echo 'suggestedits_process.php?suggestion_details='.$suggestion_details; ?>" method="post">
		 <table class='table table-responsive'>
         <tbody>
		 <tr>
		 	<td>File Name</td><td><?php echo $file_name; ?></td>
		 </tr>
		 <tr>
		 	<td>Edit in</td>
		 	<td>
		 	<div class="form-group">
		 			<select class="form-control" name="suggestion_edit_in" id="suggestion_edit_in">
		 				<option value="Title">Title</option>
		 				<option value="Subject">
		 					<?php
		 					if($filetype == "notes")
		 						echo "Subject";
		 					else
		 						echo "Authors";
		 					?>
		 				</option>
		 				<option value="Field"><?php
		 					if($filetype == "notes")
		 						echo "Field";
		 					else
		 						echo "Useful In Exam";
		 					?>
		 				</option>
		 				<option value="Topics">Topics</option>
		 				<option value="Description">Description</option>
		 				<option value="File content">File content</option>
		 			</select>
					</div>
			</td>
		 </tr>
		 <tr>
		 	<td>Description</td>
		 	<td>
		 	<div class="form-group">
		 	<textarea class="form-control" rows="5" name="suggestion_description" placeholder="Write Other Description about your suggestion."></textarea>
		 	</div>
		 	</td>
		 </tr>
		 <tr>
		 	<td colspan="2" style="text-align: center;">
		 		<input type="submit" name="btnSuggestEdits" id="btnSuggestEdits" class="btn btn-info" value="Submit">&nbsp;
		 		<input type="reset" name="btnResetSuggestEdits" id="btnResetSuggestEdits" class="btn btn-warning" value="Reset">&nbsp;
				<a href="index.php"><input type="button" name="back" id="goback" class="btn btn-info" value="Back"></a>
		 	</td>
		 </tr>
		 </tbody>
		 </table>
		 </form>
		 </div>
		 </div>
	</div>
	</div>
	<?php endif; ?>
	<?php if(logged_in() == false): ?>
	<?php redirect("403.php") ?>
	<!--<div class="row">
		<br/>
		<div class="jumbotron">
		<center>Looks like you are not logged in. Please&nbsp;<a href='login.php'>Login</a>&nbsp;...</center>
		</div>
	</div>-->
	<?php endif; ?>
</body>
</html>
<?php include("includes/footer.php") ?>