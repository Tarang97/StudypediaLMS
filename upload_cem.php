<?php include("includes/header.php"); ?>
<?php include("includes/nav.php"); ?>
<html>
<head>
<title>Studypedia | Upload Competitive Exam Material</title>
<script src="js/jquery.js"></script>
<script src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$('#btnUploadCEM').click(function(){
	var atLeastOneIsChecked = $('input:checkbox').is(':checked');
	if(atLeastOneIsChecked == true)
	{
	$("#UploadCEMForm").submit();
	}
	else
	{
		$('#exam_in_cem_error').html("<div class='alert alert-danger' role='alert'><strong>Warning!</strong>Select at least one Exam name.</div>");
	}
});

$('#file_cem').change(function(){
      var fileSize = this.files[0].size;
      var fileExtension = ['pdf','pptx','doc','mp4','avi','webm'];
      if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1){
        $('#file_cem_error').html("<div class='alert alert-danger' role='alert'><strong>Warning!</strong>Your file won't uploaded...Filetype is not supported.</div>");    //
        $('#file_cem').val(' ');
      }
      else if(fileSize > 20000000){
       $('#file_cem_error').html("<div class='alert alert-danger' role='alert'><strong>Warning!</strong>Your file won't uploaded...Filesize is larger than 20 MB.</div>");    //
        $('#file_cem').val(' ');
      }
      else{
        $('#file_cem_error').html("<div class='alert alert-success' role='alert'><strong>Success!</strong>File is supported.</div>");
      }
    });
});


</script>
</head>
<body>
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
			<h2>Upload Competitive Exam Material</h2>
			</div>
		</div>
	</div>
	  	<?php if(logged_in()):?>
	<div class="row">
		<div class='panel panel-default'>
		 <div class='panel-body'>
		 <form name="UploadCEMForm" id="UploadCEMForm" action="upload_cem_process.php" method="post" enctype="multipart/form-data">
		 <table class='table table-responsive'>
         <tbody>
		 <tr>
		 	<td>Title<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
					<input type="text" name="title_cem" id="title_cem" tabindex="1" class="form-control"  maxlength="50" required="required">
					<span class="help-block">Maximum 50 characters</span>
					</div>
			</td>
		 </tr>
		 <tr>
		 	<td>Material File<sup style="color:red;">*</sup></td>
		 	<td>
		 	<div class="form-group">
		 	<input type="file" class="form-control" id="file_cem" name="file_cem"  required="required">
      			<span id="file_cem_error"></span>
      			<span class="help-block">Filetype must be of '.pdf','.pptx','.doc','.mp4' or '.avi',Filesize must be less than 20 MB.</span>
      			</div>
      		</td>
		 </tr>
		 <tr>
		 	<td>Useful In Exam<sup style="color:red;">*</sup></td>
		 	<td>
		 		<div class="form-group">
		 			<?php 
              		$fetch_cem_category = "SELECT * FROM cem_category";
              		$cem_category = query($fetch_cem_category);
              		foreach ($cem_category as $category) {
              			echo "<label class='checkbox-inline'><input type='checkbox' name='exam_in_cem[]' class='exam_in_cem' value='".strtoupper($category['category_name'])."'>".strtoupper($category['category_name'])."</label>";
              			// echo "<li><a href='cem.php?cem_category=".$category['category_name']."'>".strtoupper($category['category_name'])."</a></li>";
              		}
              		?>
  			<!--label class="checkbox-inline"><input type="checkbox" name="exam_in_cem[]" class="exam_in_cem" value="GRE">GRE</label>
			<label class="checkbox-inline"><input type="checkbox" name="exam_in_cem[]" class="exam_in_cem" value="GATE">GATE</label>
			<label class="checkbox-inline"><input type="checkbox" name="exam_in_cem[]" class="exam_in_cem" value="CAT">CAT</label>
			<label class="checkbox-inline"><input type="checkbox" name="exam_in_cem[]" class="exam_in_cem" value="GMAT">GMAT</label>
			<label class="checkbox-inline"><input type="checkbox" name="exam_in_cem[]" class="exam_in_cem" value="UPSC">UPSC</label-->
			<span id="exam_in_cem_error"></span>
			<span class="help-block">Select Exams in which this file can be used for preparation</span>
		</div>
		 	</td>
		 </tr>
		 <tr>
		 	<td>Material Authors<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
				<input type="text" name="authors_cem" id="authors_cem" tabindex="1" class="form-control"  maxlength="50"  required="required">
					<span class="help-block">Write Authors who created this material</span>
					</div>
			</td>
		 </tr>
		 <tr>
		 	<td>Topics<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
				<input type="text" name="topics_cem" id="topics_cem" tabindex="1" class="form-control"  maxlength="50"  required="required">
					<span class="help-block">Write topics covered in this file.(Maximum 50 characters)</span>
					</div>
			</td>
		 </tr>
		 <tr>
		 	<td>Description<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
  			<textarea class="form-control" rows="3" id="description_cem" name="description_cem" maxlength="250"  required="required"></textarea>
        <span class="help-block">Write other description about file like file type or file content,so other users can understand about file easily.(Maximum 250 characters)</span>
		</div></td>
		 </tr>
		 <tr>
		 	<td colspan="2" style="text-align: center;">
		 		<input type="button" name="" id="btnUploadCEM" class="btn btn-info" value="Upload File">
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
		<a href='login.php'>Login</a> to Upload Competitive Exam Material
		</div>
	</div-->

	<?php endif; ?>
  </div>
  </body>
  </html>
  <?php include("includes/footer.php") ?>