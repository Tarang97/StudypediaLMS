<?php include("includes/header.php") ?>
<?php include("includes/nav.php") ?>
<html>
<head>
<title>Studypedia | Upload Notes</title>
<script src="js/jquery.js"></script>
<script src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$('#btnUploadNotes').click(function(){
$("#UploadNotesForm").submit();
});

$('#file_notes').change(function(){
      var fileSize = this.files[0].size;
      var fileExtension = ['pdf','pptx','docx','mp4','mkv','doc','ppt'];
      if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1){
        $('#file_notes_error').html("<div class='alert alert-danger' role='alert'><strong>Warning!</strong>Your file won't uploaded...Filetype is not supported.</div>");    //
        $('#file_notes').val(' ');
      }
      else if(fileSize > 20000000){
       $('#file_notes_error').html("<div class='alert alert-danger' role='alert'><strong>Warning!</strong>Your file won't uploaded...Filesize is larger than 20 MB.</div>");    //
        $('#file_notes').val(' ');
      }
      else{
        $('#file_notes_error').html("<div class='alert alert-success' role='alert'><strong>Success!</strong>File is supported.</div>");
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
			<h2>Upload Notes</h2>
			</div>
		</div>
	</div>
	  	<?php if(logged_in()):?>
	<div class="row">
		<div class='panel panel-default'>
		 <div class='panel-body'>
		 <form name="UploadNotesForm" id="UploadNotesForm" action="upload_notes_process.php" method="post" enctype="multipart/form-data">
		 <table class='table table-responsive'>
         <tbody>
		 <tr>
		 	<td>File Title<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
					<input type="text" name="file_title_notes" id="file_title_notes" tabindex="1" class="form-control"  maxlength="50" required="required">
					<span class="help-block">Maximum 50 characters</span>
					</div>
			</td>
		 </tr>
		 <tr>
		 	<td>Upload File<sup style="color:red;">*</sup></td>
		 	<td>
		 	<div class="form-group">
		 	<input type="file" class="form-control" id="file_notes" name="file_notes"  required="required">
      			<span id="file_notes_error"></span>
      			<span class="help-block">Filetype must be of '.pdf','.pptx','.docx','.mp4' or '.mkv','.doc','.ppt',Filesize must be less than 20 MB.</span>
      			</div>
      		</td>
		 </tr>
		 <tr>
		 	<td>Subject<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
				<input type="text" name="subject_notes" id="subject_notes" tabindex="1" class="form-control"  maxlength="50"  required="required">
					<span class="help-block">Maximum 50 characters</span>
					</div>
			</td>
		 </tr>
		 <tr>
		 	<td>Education Field<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
				<input type="text" name="education_field_notes" id="education_field_notes" tabindex="1" class="form-control"  maxlength="50"  required="required">
					<span class="help-block">Write Education Field related to this file ex.CE,IT,MCA,B.com etc.(Maximum 50 characters)</span>
					</div>
			</td>
		 </tr>
		 <tr>
		 	<td>Topics<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
				<input type="text" name="topics_notes" id="topics_notes" tabindex="1" class="form-control"  maxlength="50"  required="required">
					<span class="help-block">Write topics covered in this file.(Maximum 50 characters)</span>
					</div>
			</td>
		 </tr>
		 <tr>
		 	<td>Description<sup style="color:red;">*</sup></td>
		 	<td><div class="form-group">
  			<textarea class="form-control" rows="3" id="description_notes" name="description_notes" maxlength="250"  required="required"></textarea>
        <span class="help-block">Write other description about file like file type or file content,so other users can understand about file easily.(Maximum 250 characters)</span>
		</div></td>
		 </tr>
		 <tr>
		 	<td colspan="2" style="text-align: center;">
		 		<input type="button" name="" id="btnUploadNotes" class="btn btn-info" value="Upload File">
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
		<a href='login.php'>Login</a> to Upload Notes
		</div>
	</div-->

	<?php endif; ?>
  </div>
  </body>
  </html>
  <?php include("includes/footer.php") ?>