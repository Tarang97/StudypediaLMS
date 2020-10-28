<body>
<!-- Start Preloader -->
<div id="loading" style="display: none;">
  <div class="element">
    <div class="sk-folding-cube">
      <div class="sk-cube1 sk-cube"></div>
      <div class="sk-cube2 sk-cube"></div>
      <div class="sk-cube4 sk-cube"></div>
      <div class="sk-cube3 sk-cube"></div>
    </div>
  </div>
</div>
<!-- End Preloader -->
<nav class="navbar navbar-default" role="navigation">
  <div class="container">
	    <div class="navbar-header">
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
	        </button>
	        <a class="navbar-brand" href="index.php">Studypedia</a>
	    </div>
	    <!--/.navbar-header-->
	    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" style="height: 1px;">
	        <ul class="nav navbar-nav">
			<?php if(logged_in() == false):?>
		        <li class="dropdown">
		            <a href="login.php"><i class="fa fa-user"></i><span>Login</span></a>					
		        </li>
				<li class="dropdown">
		            <a href="register.php"><i class="fa fa-user"></i><span>Register</span></a>					
		        </li>
			<?php endif; ?>
			<?php if(logged_in()):?>
		 <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell" aria-hidden="true"></i>
		            <span>
		            	Notification
		            </span>
		   </a>
		   <?php 
				$user_email = null;
				if(isset($_SESSION['email']))	$user_email = $_SESSION['email'];

				$user_details_sql = "SELECT id FROM users WHERE email = '$user_email'";

				$user_details_result = query($user_details_sql);
				$user_id = 0;
				foreach ($user_details_result as $temp) {
					$user_id = $temp['id'];
				}
					$result_notification = array();
					$sql = "SELECT * FROM notification where for_user_id = '$user_id' ORDER BY date_time DESC";
					$result1 = query($sql);
					foreach ($result1 as $temp) {
						$result_notification[] = $temp;
					}
		
          echo "<ul class='dropdown-menu notify-drop'>";
            echo "<div class='drop-content' style='width:300px;max-height: 300px;overflow: scroll;background-color: lightblue;'>";
            	
            	//echo print_r($result_notification);
            if(sizeof($result_notification) == 0)
            {
            	echo "<li>";
            	echo "<b><center>No notification for you</center></b>";
            	echo "</li>";
            }
            	foreach ($result_notification as $notification) {
            		echo "<b><a style='color:black;' href='".$notification['link']."' class='notification_link'>";
            		echo "<div style='margin:5px;'>";
            		echo "<li>";
            		echo $notification['message']."<br/>";
            		echo "<span style='float:right;'>".$notification['date_time']."</span>";
            		echo "</li></div></a></b><hr style='border:1px blue solid;'/>";
            	}
           				
            	
            echo "</div>";
          echo "</ul>";
          ?>
					<li class="dropdown">
		            <a href="#"><i class="fa fa-user" aria-hidden="true"></i> 
		            <span>
		            	<?php if (isset($_SESSION['first_name'])) : ?>
       					<?php echo $_SESSION['first_name']." <i class='fa fa-angle-double-down'></i>"; ?>
    					<?php else: ?>
       					User <i class='fa fa-sort-down'></i>
    					<?php endif ?>
		            </span></a>
					<ul class="dropdown-menu">
			            <li><a href="viewprofile.php">Profile</a></li>
			            <li><a href="logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
		            </ul>
		        </li>
			<?php endif; ?>
		    </ul>
	    </div>
	    <div class="clearfix"> </div>
	  </div>
	    <!--/.navbar-collapse-->
</nav>
<nav class="navbar nav_bottom" role="navigation" style='border: 1px solid #f1b458;'>
 <div class="container">
 <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header nav_2">
      <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
   </div> 
   <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
        <ul class="nav navbar-nav nav_1">
            <li><a href="index.php">Home</a></li>
			<!--li><a href="about.php">About</a></li-->
            <li><a href="notes.php">Notes</a></li>
    		<li class="dropdown mega-dropdown active">
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ebooks<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
              	<?php 
              		$fetch_ebook_category = "SELECT * FROM ebook_category";
              		$ebook_category = query($fetch_ebook_category);
              		foreach ($ebook_category as $category) {
              			echo "<li><a href='ebook.php?ebook_category=".$category['category_name']."'>".ucwords($category['category_name'])."</a></li>";
              		}
              	?>
              </ul>
            </li>				
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Competitive Exam<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <?php 
              		$fetch_cem_category = "SELECT * FROM cem_category";
              		$cem_category = query($fetch_cem_category);
              		foreach ($cem_category as $category) {
              			echo "<li><a href='cem.php?cem_category=".$category['category_name']."'>".strtoupper($category['category_name'])."</a></li>";
              		}
              	?>
              </ul>
            </li>	                    
			<li><a href="forum/index.php" target="_blank">Q/A</a></li>                        
            <li class="last"><a href="contact.php">Contact</a></li>
            <?php
            	if(logged_in())
				{
					$user_role = null;
					$user_email = $_SESSION['email'];
					$user_role_sql = "SELECT role FROM users WHERE email = '$user_email'";
					$user_role_result = query($user_role_sql);
					foreach ($user_role_result as $temp) {
					$user_role = $temp['role'];
					}
					if($user_role == 'Moderator')
					{
						echo "<li class='last'><a href='reported_files.php'>Reported Files</a></li>";
					}
				}
            ?>                                    
	</div>				
			</li>			            
            
        </ul>
     </div><!-- /.navbar-collapse -->
   <!--</div>-->
</nav>
