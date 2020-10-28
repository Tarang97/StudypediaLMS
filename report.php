<?php include("includes/header.php") ?>
  <?php include("includes/nav.php") ?>
<html>
<head>
<title>Report File</title>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$('#report_reason').change(function(){
		var selected_item = $(this).val();
		if(selected_item == "Other"){
			$("#other_reason_text").show();
		}
		else
		{
			$("#other_reason_text").hide();
		}
	});
});
</script>
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
			<h2>Report File</h2>
			</div>
		</div>
	</div>
	
		 	<?php 
		 			$filetype = null;
		 			if(isset($_REQUEST["file_type"]))  $filetype = $_REQUEST["file_type"];			//'notes' or 'cem'(Competitive Exam Material)
		 			if(isset($_REQUEST["note_id"]))
		 			{
					$note_id = $_REQUEST["note_id"];
					$sql = "SELECT * FROM notes where note_id = '".$note_id."' ";
					$result1 = query($sql);
					}
					elseif(isset($_REQUEST["cem_id"]))
					{
					$cem_id = $_REQUEST["cem_id"];
					$sql = "SELECT * FROM competitive_exam where cem_id = '".$cem_id."' ";
					$result1 = query($sql);	
					}
					$report_result = array();
					$i = 1;
					foreach ($result1 as $temp) {
						if($i<=1)
						{
						// echo "<td>".$temp['title']."</td>";					
						$report_result = $temp;				//use $report_result for furthur use of reported file
						$i++;
						}
					}
			?>
	<div class="row">
		<div class="jumbotron">
		If something is wrong with this file then let us know.Our moderators will check file and take necessary actions.
		<?php
		if(isset($report_result['note_id']))
		{
		echo "If there is a minor mistake in file then you can <a href='suggestedits.php?file_type=notes&note_id=". $report_result['note_id']."'>Suggest Edits</a> to file uploader.";
		}
		elseif(isset($report_result['cem_id']))
		{
		echo "If there is a minor mistake in file then you can <a href='suggestedits.php?file_type=cem&cem_id=". $report_result['cem_id']."'>Suggest Edits</a> to file uploader.";
		}
		?>
		</div>
	</div>

	<div class="row">
		<div class='panel panel-default'>
		 <div class='panel-body'>
		 <form name="ReportForm" id="ReportForm" action="report_process.php" method="post">
		 <table class='table table-responsive'>
         <tbody>
		 <tr>
		 	<td>File Name</td>
		 	<td><?php
		 	if(isset($_REQUEST["note_id"]))
		 	{
		 		echo $report_result['title'];
			}
			elseif(isset($_REQUEST["cem_id"]))
			{
				echo $report_result['cem_name'];
			}
		 	 ?></td>
		 </tr>
		 <tr>
		 	<td>Reason</td>
		 	<td>
		 	<div class="form-group">
		 			<select class="form-control" name="report_reason" id="report_reason">
		 				<option value="This file is not Study Related.">This file is not Study Related.</option>
		 				<option value="File Title is not according to File content.">File Title is not according to File content.</option>
		 				<option value="File Subject is not according to File content.">File Subject is not according to File content.</option>
		 				<option value="File Field is not according to File content.">File Field is not according to File content.</option>
		 				<option value="File Topics is not according to File content.">File Topics is not according to File content.</option>
		 				<option value="File Description is not according to File content.">File Description is not according to File content.</option>
		 				<option value="Other">Other</option>
		 			</select><br/>
					<span id="other_reason_text" style="display: none"><input type="text" name="other_report" id="other_report" tabindex="1" class="form-control" placeholder="Write Other Reason Here"></span>
					</div>
				</td>
		 </tr>
		 <tr>
		 	<td>Description</td>
		 	<td>
		 	<div class="form-group">
		 	<textarea class="form-control" rows="5" name="report_description" placeholder="Write Other Description related to file reporting.It will help us to understand your reason for report easily." required="required"></textarea>
		 	</div>
		 	</td>
		 </tr>
		 <tr>
		 	<?php
		 	if(isset($report_result['note_id']))
		 	{
		 		$_SESSION['report_file_id'] = $report_result['note_id']; 
		 		$_SESSION['report_file_type'] = "notes";
		 		$_SESSION['report_file_name'] = $report_result['title'];
		 		$_SESSION['report_to_userid'] = $report_result['uploaded_by_userid'];
		 	}
		 	elseif (isset($report_result['cem_id'])) {
		 	$_SESSION['report_file_id']	= $report_result['cem_id'];
		 	$_SESSION['report_file_type'] = "cem";
		 		$_SESSION['report_file_name'] = $report_result['cem_name'];
		 		$_SESSION['report_to_userid'] = $report_result['cem_uploaded_by_userid'];
		 	}
			?>
		 	<td colspan="2" style="text-align: center;">
				<input type="submit" name="btnReport" id="btnReport" class="btn btn-info" value="Report">&nbsp;
		 		<input type="reset" name="btnResetReport" id="btnResetReport" class="btn btn-warning" value="Reset">&nbsp;
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
	<?php redirect("403.php"); ?>
	<!--<div class="row">
		<br/>
		<div class="jumbotron">
		
		<center>Looks like you are not logged in. Please&nbsp;<a href='login.php'>Login</a>&nbsp;to report the file.</center>
		</div>
	</div>-->
	<?php endif; ?>
</body>
</html>
<?php

?>
<?php include("includes/footer.php") ?>