<?php
	if($_POST)
	{
		include_once 'functions/db.php';
		include_once 'functions/db_details.php';
		
		$name = $_POST['name'];
		$email = $_POST['email'];
		$name = strip_tags($name);
		$email = strip_tags($email);
		
		if(empty($email) || empty($name)) {
			echo "Please enter required fields";
		}
		else {
			$sql = "INSERT INTO guestlist (name, email, signup_date, status) VALUES('$name','$email',now(),'1')";
			$result =  query($sql);
			
			if($query) {
				
				echo "Subscribed Successfully";
			}
		}
	}		
?>