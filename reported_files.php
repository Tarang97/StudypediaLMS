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
  ?>
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
			<h2>Reported Files</h2>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="jumbotron">
		Following Files are reported by Users....Please moderate files and take appropriate actions....
		</div>
	</div>
	<div class="row">
			
                    <?php 
                    echo "<div class='panel panel-default'>";
                    echo "<div class='panel panel-body'>";
                   	echo "<table class='table table-responsive'>";
	                echo "<tbody>";
	           
					$result_reported_files = array();
					$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM report_files where report_stage = 'No Action' LIMIT {$start}, {$perPage}";
					$result1 = query($sql);
					foreach ($result1 as $temp) {
						$result_reported_files[] = $temp;
					}
					if(sizeof($result_reported_files) == 0)
					{
						echo "No Reported Files Yet.";
					}

					//to count no of pages
					$total_result = $con->query("SELECT FOUND_ROWS() as total");
					foreach ($total_result as $temp) {
						$total = $temp['total'];
					}
					$pages = ceil($total/$perPage);
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
			                    if(sizeof($notes_result) == 0)
			                    {
			                    	echo "File is not Available.";
			                    }

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
			                    				<a href='delete_file.php?filetype=notes&note_id= ".$row['note_id']." &file_path= ".$row['file_path']." &report_id=  ".$report_id." &report_file_id= ".$report_file_id."'><button class='btn btn-danger' type='button'>Delete File</button></a>
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
					                       	
					                		//echo "<tr><td colspan='3'>"."Uploaded By ".$row['user']." on ".$row['date']."</td></tr>";
					        					// echo "<tr>";
			               //  					echo "<td colspan='2' style='text-align: center;width:10%'>";
			               //  					if(logged_in())
					        					// {
					        					// echo "<a target='_blank' href='".$row['file_path']."'><button class='btn btn-primary' type='button'>Download</button></a>  ";
										        // echo "<a target='_blank' href='".$row['file_path']."'><button class='btn btn-danger' type='button'>Delete File</button></a>  ";
										        // }    
								          //       echo "</td>";
								          //       echo "</tr>";        		
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
			                    if(sizeof($cem_result) == 0)
			                    {
			                    	echo "File is not Available.";
			                    }

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
			                    			<a href='delete_file.php?filetype=cem&cem_id= ".$row['cem_id']." &cem_file_path= ".$row['cem_file_path']." &report_id=  ".$report_id." &report_file_id= ".$report_file_id."'><button class='btn btn-danger' type='button'>Delete File</button></a>
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
					                       	
					                		//echo "<tr><td colspan='2'>"."Uploaded By ".$row['cem_uploaded_by']." on ".$row['cem_uploaded_on']."</td></tr>";
					        					// echo "<tr>";
			               //  					echo "<td colspan='2' style='text-align: center;width:10%'>";
			               //  					if(logged_in())
					        					// {
					        					// echo "<a target='_blank' href='".$row['cem_file_path']."'><button class='btn btn-primary' type='button'>Download</button></a>  ";
										        // echo "<a target='_blank' href='".$row['cem_file_path']."'><button class='btn btn-danger' type='button'>Delete File</button></a>  ";
										        // }    
								          //       echo "</td>";
								          //       echo "</tr>";        		
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
	                    echo "<a href='reported_no_change.php?report_id= ".$report_id." '><button class='btn btn-link' type='button'>No Changes(Remove From Reported Files)</button></a>";
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
		<br/>
		<div class="jumbotron">
		Looks like you are not logged in. Please<a href='login.php'>Login</a>
		</div>
	</div>-->
	<?php endif; ?>
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