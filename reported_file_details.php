<?php include("includes/header.php") ?>
  <?php include("includes/nav.php") ?>
  <?php include("functions/db_details.php"); ?>
  <?php
	$con = mysqli_connect($host, $user, $pass, $dbname);
	//User Input
	$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	$perPage = isset($_POST['per-page']) && $_POST['per-page'] <= 50 ? (int)$_POST['per-page'] : 5;

	//Positioning
	$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

  	$user_email = null;
	if(isset($_SESSION['email']))	$user_email = $_SESSION['email'];

	$user_details_sql = "SELECT id FROM users WHERE email = '$user_email'";

	$user_details_result = query($user_details_sql);
	$user_id = 0;
	foreach ($user_details_result as $temp) {
		$user_id = $temp['id'];
	}
	$result_reported_files = array();
	$report_id = null;
	if(isset($_REQUEST['report_id']))		
	{
		$report_id = $_REQUEST['report_id'];
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM report_files where report_stage = 'No Action' and report_to_userid = '$user_id' and report_id = '$report_id' LIMIT {$start}, {$perPage}";
	}
	else
	{
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM report_files where report_stage = 'No Action' and report_to_userid = '$user_id' ORDER BY report_id DESC LIMIT {$start}, {$perPage}";
	}

	$result1 = query($sql);
	foreach ($result1 as $temp) {
		$result_reported_files[] = $temp;
	}
	$report_to_userid = null;
	foreach ($result_reported_files as $one_report) 
	{
			$report_to_userid = $one_report['report_to_userid'];
	}

					//to count no of pages
					$total_result = $con->query("SELECT FOUND_ROWS() as total");
					foreach ($total_result as $temp) {
						$total = $temp['total'];
					}
					$pages = ceil($total/$perPage);
?>

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
			<h2>Reported File</h2>
			</div>
		</div>
	</div>
	<?php if(logged_in() && $report_to_userid == $user_id):?>
	<div class="row">	
                    <?php 
                    echo "<div class='panel panel-default'>";
                    echo "<div class='panel panel-body'>";
                   	echo "<table class='table table-responsive'>";
	                echo "<tbody>";
	           
					foreach ($result_reported_files as $one_report) 
					{		
						$report_id = $one_report['report_id'];
						$report_file_name = $one_report['report_file_name'];
						$report_file_type = $one_report['report_file_type'];
						$report_file_id = $one_report['report_file_id'];
						$report_reason = $one_report['report_reason'];
						$report_description = $one_report['report_description'];
						$report_date = $one_report['report_date'];
						$reported_by_userid = $one_report['reported_by_userid'];

						echo "<tr>";
						echo "<td>File Name</td>";
						echo "<td>".$report_file_name."</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>File Type</td>";
						echo "<td>".$report_file_type."</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>Reason</td>";
						echo "<td>".$report_reason."</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>Description</td>";
						echo "<td>".$report_description."</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td colspan='2'>";

						echo "<div class='panel panel-default'>";
						echo "<div class='panel-body'>";
						echo "<table class='table table-responsive'>";
	                    echo "<tbody>";
	                    if($report_file_type == "notes")
	                    {
	                    		$notes_result = array();
								$sql = "SELECT * FROM notes where note_id = ".$report_file_id;
								$result1 = query($sql);
								foreach ($result1 as $temp) {
									$notes_result[] = $temp;
								}
			                    $i = 1;

			    					foreach ($notes_result as $row) {
										if($i==1)
										{
											echo "<tr>";
											echo "<td colspan='3'><h2>File Contents</h2></td>";
											echo "</tr>";
											echo "<tr>";
				                    		echo "<td>Title</td>";
				                    		echo "<td>".$row['title']."</td>";
				                    		if(logged_in())
			                    			{
			                    			echo "<td rowspan='5' style='text-align: center;vertical-align: middle;width:15%'>
			                    			<a target='_blank' href='".$row['file_path']."'><button class='btn btn-primary' type='button'>Download</button></a><br/><br/>
			                    				<a href='edit_file.php?filetype=notes&file_id= ".$row['note_id']." '><button class='btn btn-warning' type='button'>Edit File</button></a>
			                    			</td>";
			                    			}
			                    			else{
			                    		    echo "<td rowspan='5' style='text-align: center;vertical-align: middle;width:10%'><a href='login.php'>Login</a> to Moderate this Note</td>";
			                    		    }            		
					                       	echo "</tr>";
					                       	echo "<tr>";
					                    		echo "<td>Subject</td><td>".$row['subject']."</td>";            		
					                       	echo "</tr>";
					                       	echo "<tr>";
					                    		echo "<td>Field</td><td>".$row['field']."</td>";
					                       	echo "</tr>";
					                       	echo "<tr>";
					                    		echo "<td>Topics</td><td>".$row['topics']."</td>";
					                       	echo "</tr>";
					                       	echo "<tr>";
					                    		echo "<td>Description</td><td>".$row['description']."</td>";
					                       	echo "</tr>";        		
											$i++;
											}
									}
	                    }
	                    elseif($report_file_type == "cem")
	                    {
	                    		$cem_result = array();
								$sql = "SELECT * FROM competitive_exam where cem_id = ".$report_file_id;
								$result1 = query($sql);
								foreach ($result1 as $temp) {
									$cem_result[] = $temp;
								}
			                    $i = 1;

			    					foreach ($cem_result as $row) {
										if($i==1)
										{
											echo "<tr>";
											echo "<td colspan='3'><h2>File Contents</h2></td>";
											echo "</tr>";
											echo "<tr>";
				                    		echo "<td>Title</td>";
				                    		echo "<td>".$row['cem_name']."</td>";
				                    		if(logged_in())
			                    			{
			                    			echo "<td rowspan='5' style='text-align: center;vertical-align: middle;width:10%'>
			                    			<a target='_blank' href='".$row['cem_file_path']."'><button class='btn btn-primary' type='button'>Download</button></a><br/><br/>
			                    			<a href='edit_file.php?filetype=cem&file_id= ".$row['cem_id']." '><button class='btn btn-warning' type='button'>Edit File</button></a>
			                    			</td>";
			                    			}
			                    			else{
			                    		    echo "<td rowspan='5' style='text-align: center;vertical-align: middle;width:10%'><a href='login.php'>Login</a> to Moderate this Note</td>";
			                    		    }            		
					                       	echo "</tr>";
					                       	echo "<tr>";
					                    		echo "<td>Authors</td><td>".$row['cem_authors']."</td>";            		
					                       	echo "</tr>";
					                       	echo "<tr>";
					                    		echo "<td>Useful in Exam</td><td>".$row['cem_exams']."</td>";
					                       	echo "</tr>";
					                       	echo "<tr>";
					                    		echo "<td>Topics</td><td>".$row['cem_topics']."</td>";
					                       	echo "</tr>";
					                       	echo "<tr>";
					                    		echo "<td>Description</td><td>".$row['cem_description']."</td>";
					                       	echo "</tr>";        		
											$i++;
											}
									}
	                    }       
						echo "</tbody>";
			            echo "</table>";
						echo "</div>";
						echo "</div>";

						echo "</td>";
						echo "</tr>";

						$user_details_sql = "SELECT first_name,last_name FROM users WHERE id = '$reported_by_userid'";

						$user_details_result = query($user_details_sql);

						foreach ($user_details_result as $temp) {
						$user = $temp['first_name']." ".$temp['last_name'];
						}
					
						echo "<tr><td colspan='2'>"."Reported By ".$user." on ".$report_date."<br/>";
	                    echo "</td></tr>";
					 	echo "<tr><td colspan='3'><hr style='border:2px black dotted;'/></td></tr>";
	                    }
					echo "</tbody>";
			        echo "</table>";
					echo "</div>";
					echo "</div>";
                ?>
	</div>
	<?php endif; ?>

	<?php if(logged_in() == false): ?>
	<?php redirect("403.php"); ?>
	<!--<div class="row">
		<div class="jumbotron">
		<a href='login.php'>Login</a> to See Reported File
		</div>
	</div>-->
	<?php endif; ?>

	<?php if($report_to_userid != $user_id): ?>
	<div class="row">
		<div class="jumbotron">
		It's look like you have not uploaded this file or There is not any reported Files.
		</div>
	</div>
	<?php endif; ?>
	<div class="know-more-wrapper"> <a href="index.php" class="know-more"><i class="fa fa-arrow-circle-left"></i>&nbsp;Back </a> </div>

	<div class="row">
		<center>
					<div class="pagination">
					
					<?php
					$prev_page = $page - 1; 
					if($prev_page > 0)		echo "<a href='?page=$prev_page&per-Page=$perPage'>&laquo;</a>";
					?>
					<?php for($x = 1; $x <= $pages; $x++): ?>
					  <a href="?page=<?php echo $x; ?>&per-Page=<?php echo $perPage; ?>"<?php if($page === $x) { echo 'class="active"'; } ?>><?php echo $x; ?></a>
					 <?php endfor; ?>
					<?php
					$next_page = $page+1;
					if($next_page <= $pages)		echo "<a href='?page=$next_page&per-Page=$perPage'>&raquo;</a>";
					?>

					</div>
		</center>
	</div>
	</div>
<?php include("includes/footer.php") ?>