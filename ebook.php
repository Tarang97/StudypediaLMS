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
			
			<?php display_message(); ?>

			<?php validate_user_login(); ?>
		
								
		</div>
	</div>
	<?php 
                    $ebook_category = null;
                    if(isset($_REQUEST['ebook_category']))		$ebook_category = $_REQUEST['ebook_category'];
     ?>
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
			<h2><?php echo ucwords($ebook_category); ?> E-Books</h2>
			</div>
		</div>
	</div>
	
	<div class="row">
			<div class="col-md-1">
			</div>
			<form>
			<div class="col-md-10">
				<div class="form-group">
					<input type="text" name="search" id="search_ebook" tabindex="1" class="typeahead form-control" placeholder="Search Ebook Here" autocomplete="off">
				</div>
			</div>
			</form>
			<div class="col-md-1">
			</div>
	</div>
	<div class="row">
				<?php
                    $i = 1;
					echo "<div class='panel panel-default'>";
					echo "<div class='panel-body'>";
					echo "<table class='table table-responsive'>";
                    echo "<tbody>";
					if($search_term != null)
                    {
                    	$query_ebook = "SELECT SQL_CALC_FOUND_ROWS * FROM ebooks WHERE ebook_name LIKE '%$search_term%' OR ebook_authors LIKE '%$search_term%' OR field LIKE '%$search_term%' OR topics LIKE '%$search_term%' LIMIT {$start}, {$perPage}";	
                    }
                    else
                    {
                    if($ebook_category != null)
					$query_ebook = "SELECT SQL_CALC_FOUND_ROWS * FROM ebooks WHERE field LIKE '%$ebook_category%' LIMIT {$start}, {$perPage}";
					else
					$query_ebook = "SELECT SQL_CALC_FOUND_ROWS * FROM ebooks LIMIT {$start}, {$perPage}";
					}

                    
					$ebook_result = $con->query($query_ebook);

					//to count no of pages
					$total_result = $con->query("SELECT FOUND_ROWS() as total");
					foreach ($total_result as $temp) {
						$total = $temp['total'];
					}
					$pages = ceil($total/$perPage);

                    foreach ($ebook_result as $row)
					{		
						$filepath = $row['file_path'];
						echo "<tr>";
                    		echo "<td>Name</td>";
                    		echo "<td><b>".$row['ebook_name']."</b></td>";
                    		if(logged_in())
                    		{
                    		echo "<td rowspan='5' style='text-align: center;vertical-align: middle;width:10%'>";
                    			if(strpos($filepath,".pdf") == true)
                    			{
                    				echo "<button class='btn btn-primary btnShow' type='button' value='".$filepath."'  style='width:90px'>View PDF</button><br/><br/>";
                    			}
                    		echo "<a target='_blank' href='".$filepath."'><button class='btn btn-primary' type='button' style='width:90px'>Download</button></a></td>"; 
                    		}
                    		else{
                    		    echo "<td rowspan='4' style='text-align: center;vertical-align: middle;width:10%'><a href='login.php'>Login</a> to Download this Ebook</td>";
                    		    }           		
                       	echo "</tr>";
                       	echo "<tr>";
                    		echo "<td>Authors</td><td>".$row['ebook_authors']."</td>";            		
                       	echo "</tr>";
                       	echo "<tr>";
                    		echo "<td>Topics</td><td>".$row['topics']."</td>";
                       	echo "</tr>";
                       	echo "<tr>";
                    		echo "<td>Field</td><td>".ucwords($row['field'])."</td>";
                       	echo "</tr>";
                       	echo "<tr>";
                    		echo "<td>Description</td><td>".$row['description']."</td>";
                       	echo "</tr>";
                		echo "<tr><td colspan='3'>Uploaded on ".$row['uploaded_date']."</td></tr>";	
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
						echo "No Ebook has been uploaded yet.";
					}
					echo "</tbody>";
		            echo "</table>";
		            echo "</div>";
					echo "</div>";
                ?>
                
	</div>
		
	</div>
		<center>
					<div class="pagination">
					
					<?php
					$prev_page = $page - 1; 
					if($prev_page > 0)		echo "<a href='?page=$prev_page&per-Page=$perPage&ebook_category=$ebook_category&search=$search_term'>&laquo;</a>";
					?>
					<?php for($x = 1; $x <= $pages; $x++): ?>
					  <a href="?page=<?php echo $x; ?>&per-Page=<?php echo $perPage; ?>&ebook_category=<?php echo $ebook_category; ?>&search=<?php echo $search_term; ?>"<?php if($page === $x) { echo 'class="active"'; } ?>><?php echo $x; ?></a>
					 <?php endfor; ?>
					<?php
					$next_page = $page+1;
					if($next_page <= $pages)		echo "<a href='?page=$next_page&per-Page=$perPage&ebook_category=$ebook_category&search=$search_term'>&raquo;</a>";
					?>

					</div>
		</center>		
							    <div id="dialog" style="display: none">
    </div>	
	</div>
<?php include("includes/footer.php") ?>
<script>
$(document).ready(function(){
	var ebook_data = new Array();
	//will not allow to add duplicate values in array
	function ebook_data_contains(checkValue){
		for (var i = 0;i<ebook_data.length;i++) {
			if(ebook_data[i] == checkValue)	return true;
		}
		return false;
	}
            function get_data_autocomplete()
            {
                $.getJSON('db_to_json.php?data_type=ebook', function (data) {
                    for (jsonObj of data)
                    {
                        if (typeof jsonObj == "object")
                        {
                            $.each(jsonObj, function (key, value) {
                            	if(!ebook_data_contains(value))
                                    ebook_data.push(value);
                            });
                        }
                    }
                });
            }
            get_data_autocomplete();          //call function

    $( "#search_ebook" ).autocomplete({
      source: ebook_data,
      minLength: 2,
      select:function(event,ui){
      	value = ui.item.value;
      	location.href = "ebook.php?search="+value;
      }
    });
    $(".btnShow").click(function () {
				 var filePath = $(this).attr('value');
				 var fileName = filePath.split("/")[3];
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
});
</script>