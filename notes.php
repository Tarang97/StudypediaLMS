<?php include("functions/db_details.php"); ?>
<?php 
$con = mysqli_connect($host, $user, $pass, $dbname);
//User Input
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = isset($_POST['per-page']) && $_POST['per-page'] <= 50 ? (int)$_POST['per-page'] : 5;

//Positioning
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
?>
<?php
$search_term = null;
if(isset($_REQUEST['search']))		$search_term = $_REQUEST['search'];
?>
<?php include("includes/header.php") ?>
  <?php include("includes/nav.php") ?>


  	<div class="container">
  	
  	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">

			<?php display_welcome_message(); ?>

			<?php display_message(); ?>

			<?php validate_user_login(); ?>
								
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
			<h2>Notes</h2>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="alert alert-info">
			<strong>Info:</strong> Your Uploaded material will get moderated by our moderator and get check in Plagiarism for the copied content in your file. The plagiarism criteria will be follow to keep your materials online.
		</div>
		<div class="alert alert-info">
			<strong>Info:</strong> Read the rules about plagiarism checking and moderating of your file...&nbsp; <a href="privacy.php#moderation_times">Here</a>
		</div>
	</div>
	
	<div class="row">
		 <form>
			<div class="col-md-10">
				<div class="form-group">
					<input type="text" name="search" id="search_notes" tabindex="1" class="typeahead form-control" placeholder="Search Notes Here" autocomplete="off">
				</div>
			</div>
		</form>
			<?php if(logged_in()){
			echo "<div class='col-md-2'>";
					echo "<a href='upload_notes.php'><input type='button' name='' id='' tabindex='1' class='btn btn-warning btn-block' value='Upload Notes'></a>";
			echo "</div>";
			}
			else{
				echo "<div class='col-md-2'>";
                    		    echo "<a href='login.php'>Login</a> to Upload Notes";
                echo "</div>";
                    		    }
			?>
	</div>
	<div class="row">	
                    <?php 
                    echo "<div class='panel panel-default'>";
					echo "<div class='panel-body'>";
					echo "<table class='table table-responsive'>";
                    echo "<tbody>";
                    if($search_term != null)
                    {
                    	$query_notes = "SELECT SQL_CALC_FOUND_ROWS * FROM notes WHERE title LIKE '%$search_term%' OR subject LIKE '%$search_term%' OR field LIKE '%$search_term%' OR topics LIKE '%$search_term%' LIMIT {$start}, {$perPage}";	
                    }
                    else
                    {
                    $query_notes = "SELECT SQL_CALC_FOUND_ROWS * FROM notes LIMIT {$start}, {$perPage}";
                	}
					$notes_result = $con->query($query_notes);

					//to count no of pages
					$total_result = $con->query("SELECT FOUND_ROWS() as total");
					foreach ($total_result as $temp) {
						$total = $temp['total'];
					}
					$pages = ceil($total/$perPage);

                    $i = 1;
                    foreach ($notes_result as $row)
					{
						$filepath = $row['file_path'];
							echo "<td>Title</td>";
                    		echo "<td><b>".$row['title']."</b></td>";
                    		if(logged_in())
                    		{
                    		echo "<td rowspan='5' style='text-align: center;vertical-align: middle;width:10%'>";
                    			if(strpos($filepath,".pdf") == true)
                    			{
                    				echo "<button class='btn btn-primary btnShow' type='button' value='".$filepath."'  style='width:90px'>View PDF</button><br/><br/>";
                    			}
                    			else if(strpos($filepath,".mp4") == true)
                    			{
                    				echo "<a href='#' data-backdrop='static' data-keyboard='false' data-toggle='modal' data-target='#myModal' class='start-video'><button button class='btn btn-primary showVideo' type='button' style='width:90px' value='".$filepath."'>Play Video</button></a><br/><br/>";	
                    			}
                    		echo "<a target='_blank' href='".$row['file_path']."'><button class='btn btn-primary' type='button' style='width:90px'>Download</button></a></td>";
                    		}
                    		else{
                    		    echo "<td rowspan='5' style='text-align: center;vertical-align: middle;width:10%'><a href='login.php'>Login</a> to Download this Note</td>";
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
                       	
                		echo "<tr><td colspan='3'>"."Uploaded By ".$row['user']." on ".$row['date']."<br/>";
                		if(logged_in())
                    	{
                		echo "<a href='report.php?file_type=notes&note_id= ".$row['note_id']." '>Report</a>"."<br/>";
                		echo "<a href='suggestedits.php?file_type=notes&note_id= ".$row['note_id']."'>Suggest Edits</a>";
                		echo "</td></tr>";
                		}
                		echo "<tr><td colspan='3'><hr style='border: 0; 
						  height: 1px; 
						  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
						  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
						  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
						  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);'></td></tr>";
						$i++;
					} 
					if($i == 1)
                    {
                    	echo "No notes has been uploaded yet.";
                    }
					echo "</tbody>";
		            echo "</table>";
					echo "</div>";
					echo "</div>";
                ?>
                
	</div>
		<center>
					<div class="pagination">
					
					<?php
					$prev_page = $page - 1; 
					if($prev_page > 0)		echo "<a href='?page=$prev_page&per-Page=$perPage&search=$search_term'>&laquo;</a>";
					?>
					<?php for($x = 1; $x <= $pages; $x++): ?>
					  <a href="?page=<?php echo $x; ?>&per-Page=<?php echo $perPage; ?>&search=<?php echo $search_term; ?>"<?php if($page === $x) { echo 'class="active"'; } ?>><?php echo $x; ?></a>
					 <?php endfor; ?>
					<?php
					$next_page = $page+1;
					if($next_page <= $pages)		echo "<a href='?page=$next_page&per-Page=$perPage&search=$search_term'>&raquo;</a>";
					?>

		</center>		

          </div>
              <div id="dialog" style="display: none;">
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="videoHeader" style="font-weight: bold">Modal Header</h4>
                <button type="button" class="close" id="playerClose" style="background: red;width:30px;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
                <div class="modal-body">
                  <div class="video-block">
                    <iframe id="videoSRC" width='560' height='315' src='' allowfullscreen></iframe>
                  </div>
                </div>
              </div>
            </div>
    </div>
	</div>

<?php include("includes/footer.php") ?>
<script>
$(document).ready(function(){
	var notes_data = new Array();
	//will not allow to add duplicate values in array
	function notes_data_contains(checkValue){
		for (var i = 0;i<notes_data.length;i++) {
			if(notes_data[i] == checkValue)	return true;
		}
		return false;
	}
	
            function get_data_autocomplete()
            {
                $.getJSON('db_to_json.php?data_type=notes', function (data) {
                    for (jsonObj of data)
                    {
                        if (typeof jsonObj == "object")
                        {
                            $.each(jsonObj, function (key, value) {
                            	if(!notes_data_contains(value))
                                    notes_data.push(value);
                            });
                        }
                    }
                });
            }
            get_data_autocomplete();          //call function

    $( "#search_notes" ).autocomplete({
      source: notes_data,
      minLength: 2,
      select:function(event,ui){
      	value = ui.item.value;
      	location.href = "notes.php?search="+value;
      }
    });
	$(".btnShow").click(function () {
				 var filePath = $(this).attr('value');
				 var fileName = filePath.split("/")[1];
				 if(fileName.search(".pdf") != -1)
				 {
				$("#dialog").dialog({
                    modal: true,
                    title: fileName,
                    width: 800,
                    height: 600,
                    buttons: {
                        Close: function () {
                            $(this).dialog('close');
                        }
                    },
                    open: function () {
                        var object = "<object data=\"{FileName}\" type=\"application/pdf\" width=\"800px\" height=\"600px\">";
                        object += "If you are unable to view file, you can download from <a href=\"{FileName}\">here</a>";
                        object += " or download <a target = \"_blank\" href = \"http://get.adobe.com/reader/\">Adobe PDF Reader</a> to view the file.";
                        object += "</object>";
                        object = object.replace(/{FileName}/g, filePath);
                        $("#dialog").html(object);
                    }
                }); 
				 }
            });
	$(".showVideo").click(function(){
		var filePath = $(this).attr('value');
		var fileName = filePath.split("/")[1];
		var videoSRC = document.getElementById("videoSRC");
		videoSRC.src = filePath;
		var videoHeader = document.getElementById("videoHeader");
		videoHeader.innerHTML = fileName;
	});
	//To stop video on closing of model
	$("#playerClose").on('click', function (e) {
    $("#videoSRC").attr("src", "");
});
});
</script>