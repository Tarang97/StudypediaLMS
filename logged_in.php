<?php include("includes/header.php") ?>

  
  <?php include("includes/nav.php") ?>



	<div class="jumbotron">
		<?php 

		if(logged_in()){
			set_welcome_message("WELCOME");
			redirect("index.php");

		} else {


			redirect("login.php");
		}




		?>
	</div>

<?php include("includes/footer.php") ?>