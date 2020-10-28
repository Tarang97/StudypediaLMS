<?php
session_start();
include("functions/db.php");
include("functions/functions.php");
if(isset($_REQUEST['filetype']))
{
	$filetype = $_REQUEST['filetype'];
	if($filetype == 'cem')
	{
		if(isset($_REQUEST['cem_id']) && isset($_REQUEST['cem_file_path'])){
		$file_id = $_REQUEST['cem_id'];
		$file_path = $_REQUEST['cem_file_path'];
		$delete_query = "DELETE FROM competitive_exam where cem_id = '$file_id' ";
		}
	}
	elseif ($filetype == 'notes') 
	{
		if(isset($_REQUEST['note_id']) && isset($_REQUEST['file_path'])){
			$file_id = $_REQUEST['note_id'];
			$file_path = $_REQUEST['file_path'];
			$delete_query = "DELETE FROM notes where note_id = '$file_id' ";
		}
	}
}
if(isset($file_id) && isset($file_path) && isset($delete_query)){
	if($con->query($delete_query)===TRUE){
		set_message("File and its details are successfully deleted.");
		echo "<script type='text/javascript'>";
		echo "document.location.href = 'viewprofile.php' ";
		echo "</script>";
		// $fh = fopen($cem_file_path, 'a');
		// unlink($cem_file_path);
	}
	else{
		set_message("Something Went Wrong...File and details are not deleted...Please try Again...");
		echo "<script type='text/javascript'>";
		echo "document.location.href = 'javascript:history.go(-1)' ";
		echo "</script>";
		}
}	
else
{
	set_message("Something Went Wrong...File and details are not deleted...Please try Again...");
	echo "<script type='text/javascript'>";
	echo "document.location.href = 'javascript:history.go(-1)' ";
	echo "</script>";
}
?>