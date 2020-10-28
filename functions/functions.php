<?php


/****************helper functions ********************/


function clean($string) {
	
return htmlentities($string);

}



function redirect($location){

return header("Location: {$location}");

}


function set_message($message) {

	if(!empty($message)){

		$_SESSION['message'] = $message;

	}else {

		$message = "";
	}

}

function set_welcome_message($message) {

	if(!empty($message)){

		$_SESSION['welcome_message'] = $message;

	}else {

		$message = "";
	}

}

function display_message(){

	if(isset($_SESSION['message'])) {

		echo "<center><b style='color:green;width:100%;'>".$_SESSION['message']."</b></center>";

		unset($_SESSION['message']);

	}

}

function display_welcome_message(){

	if(isset($_SESSION['welcome_message'])) {

		echo "<center><b style='color:green;width:100%;'>".$_SESSION['welcome_message']."</b></center>";

		unset($_SESSION['welcome_message']);

	}

}



function token_generator(){

$token = $_SESSION['token'] =  md5(uniqid(mt_rand(), true));

return $token;

}


function validation_errors($error_message) {

$error_message = <<<DELIMITER

<div class="alert alert-danger alert-dismissible" role="alert">
  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<strong>Warning!</strong> $error_message
 </div>
DELIMITER;

return $error_message;
		
}



function email_exists($email) {

	$sql = "SELECT id FROM users WHERE email = '$email'";

	$result = query($sql);

	if(row_count($result) == 1 ) {

		return true;

	} else {


		return false;

	}

}



function username_exists($username) {

	$sql = "SELECT id FROM users WHERE username = '$username'";

	$result = query($sql);

	if(row_count($result) == 1 ) {

		return true;

	} else {


		return false;

	}
}


function send_email($email, $subject, $msg, $headers){

return mail($email, $subject, $msg, $headers);

}



/****************Validation functions ********************/



function validate_user_registration(){

	$errors = [];

	$min = 3;
	$max = 20;

	if($_SERVER['REQUEST_METHOD'] == "POST") {

		$first_name 		= clean($_POST['first_name']);
		$last_name 			= clean($_POST['last_name']);
		$username 		    = clean($_POST['username']);
		$email 				= clean($_POST['email']);
		$password			= clean($_POST['password']);
		$confirm_password	= clean($_POST['confirm_password']);


		if(strlen($first_name) < $min) {

			$errors[] = "Your first name cannot be less than {$min} characters";

		}

		if(strlen($first_name) > $max) {

			$errors[] = "Your first name cannot be more than {$max} characters";

		}

		if(strlen($last_name) < $min) {

			$errors[] = "Your Last name cannot be less than {$min} characters";

		}


		if(strlen($last_name) > $max) {

			$errors[] = "Your Last name cannot be more than {$max} characters";

		}

		if(strlen($username) < $min) {

			$errors[] = "Your Username cannot be less than {$min} characters";

		}

		if(strlen($username) > $max) {

			$errors[] = "Your Username cannot be more than {$max} characters";

		}


		if(username_exists($username)){

			$errors[] = "Sorry that username is already is taken";

		}

		if(email_exists($email)){

			$errors[] = "Sorry that email already is registered";

		}

		if(strlen($email) < $min) {

			$errors[] = "Your email cannot be more than {$max} characters";

		}

		if($password !== $confirm_password) {

			$errors[] = "Your password fields do not match";

		}

		if(!empty($errors)) {

			foreach ($errors as $error) {

			echo validation_errors($error);
			
			}


		} else {


			if(register_user($first_name, $last_name, $username, $email, $password)) {

				set_message("<p class='bg-success text-center'>Registration Successful...Please check your email or spam folder for activation link</p>");

				redirect('index.php');

			} else {

				set_message("<p class='bg-danger text-center'>Sorry we could not register the user.Please try again</p>");

				redirect("register.php");

			}

		}



	} // post request 



} // function 

/****************Register user functions ********************/

function register_user($first_name, $last_name, $username, $email, $password) {


	$first_name = escape($first_name);
	$last_name  = escape($last_name);
	$username   = escape($username);
	$email      = escape($email);
	$password   = escape($password);

	if(email_exists($email)) {


		return false;


	} else if (username_exists($username)) {

		return false;

	} else {

		$password   = md5($password);

		$validation_code = md5($username + microtime());

		$sql = "INSERT INTO users(first_name, last_name, username, email, password, validation_code, active)";
		$sql.= " VALUES('$first_name','$last_name','$username','$email','$password','$validation_code', 0)";
		$result = query($sql);
		confirm($result);


		$subject = "Activate Account";
		/*$msg = "Hi .'$first_name'.'$last_name'<br/>Thanks for creating a Studypedia account.<br/>
		Please verify your email address by clicking the link below. This confirms that your email address is correct so that we can use it to help you recover your password in the future, should you ever need to do so. <br/>
		http://localhost:8090/Studypedia/activate.php?email=$email&code=$validation_code
		<br/>If clicking the link doesn't work, you can copy and paste it into your browser. <br/>
		- The Studypedia Team";*/
		$msg = '<html><head><link rel="stylesheet" href="css/email.css" type="text/css" /></head>
					<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="" class="background">
<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" class="background">
    <tr>
      <td align="center" valign="top" width="100%" class="background">
        <center>
          <table cellpadding="0" cellspacing="0" width="600" class="wrap">
            <tr>
              <td valign="top" class="wrap-cell" style="padding-top:30px; padding-bottom:30px;">
                <table cellpadding="0" cellspacing="0" class="force-full-width">
                  <tr>
                   <td height="60" valign="top" class="header-cell">
                      <img width="196" height="60" src="images/studypedia.jpg" alt="logo">
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" class="body-cell">

                      <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
                        <tr>
                          <td valign="top" style="padding-bottom:15px; background-color:#ffffff;">
                            <h1>Account Activation</h1>
                          </td>
                        </tr>
                        <tr>
                          <td valign="top" style="padding-bottom:20px; background-color:#ffffff;">
                            <b>Hey '.$first_name.',</b><br>
                            We are really excited for you to join our community! You are just one click away from activate your account.
                          </td><br>
						  <td>This confirms that your email address is correct so that we can use it to help you recover your password in the future, should you ever need to do so.</td>
                        </tr>
                        <tr>
                          <td>
                            <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                              <tr>
                                <td style="width:200px;background:#008000;">
                                  <div>
                                      <center>
                                    
									<!--Activate Account-->
                                        <a href="http://localhost:8090/Studypedia/activate.php?email=$email&code=$validation_code"
                                  style="background-color:#008000;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:18px;line-height:40px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;">Activate Account</a>
                                    
                                      </center>
                                    </div>
                                </td>
								<td><b>Or</b></td>
								<td>If clicking the button does not works, then click this link or copy this address to the browsers address bar. </td>
								<td><a href="http://localhost:8090/Studypedia/activate.php?email=$email&code=$validation_code"></a></td>
                                <td width="360" style="background-color:#ffffff; font-size:0; line-height:0;">&nbsp;</td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td style="padding-top:20px;background-color:#ffffff;">
                            Thank you so much,<br>
                            Studypedia Team
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" class="footer-cell">
                      <h3><b>Studypedia</b></h3><br/>
                      <a href="../terms.php">Terms</a>&nbsp; |&nbsp; <a href="../privacy.php">Privacy</a>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </center>
      </td>
    </tr>
  </table>
					</body>
				</html>';

		$headers = "From: noreply@studypedia.com";

		send_email($email, $subject, $msg, $headers);

		return true;

	}
	
} 


/****************Activate user functions ********************/


function activate_user() {

	if($_SERVER['REQUEST_METHOD'] == "GET") {

		if(isset($_GET['email'])) {

			$email = clean($_GET['email']);

			$validation_code = clean($_GET['code']);


			$sql = "SELECT id FROM users WHERE email = '".escape($_GET['email'])."' AND validation_code = '".escape($_GET['code'])."' ";
			$result = query($sql);
			confirm($result);

			if(row_count($result) == 1) {

			$sql2 = "UPDATE users SET active = 1, validation_code = 0 WHERE email = '".escape($email)."' AND validation_code = '".escape($validation_code)."' ";	
			$result2 = query($sql2);
			confirm($result2);

			set_message("<p class='bg-success'>Your account has been activated please login</p>");

			redirect("login.php");


		} else {

			set_message("<p class='bg-danger'>Sorry Your account could not be activated </p>");

			redirect("login.php");

			}

		} 

	}

} // function 

/****************Validate user login functions ********************/



function validate_user_login(){

	$errors = [];

	$min = 3;
	$max = 20;



	if($_SERVER['REQUEST_METHOD'] == "POST") {


		$email 		= clean($_POST['email']);
		$password	= clean($_POST['password']);
		$remember   = isset($_POST['remember']);

		if(empty($email)) {

			$errors[] = "Email field cannot be empty";

		}

		if(empty($password)) {

			$errors[] = "Password field cannot be empty";

		}

		if(!empty($errors)) {

				foreach ($errors as $error) {

				echo validation_errors($error);
				
				}


			} else {


				if(login_user($email, $password, $remember)) {


					redirect("logged_in.php");


				} else {

				echo validation_errors("Your credentials are not correct");		

				}

			}

	}


} // function 





/****************User login functions ********************/


	function login_user($email, $password, $remember) {


		$sql = "SELECT first_name,password, id FROM users WHERE email = '".escape($email)."' AND active = 1";

		$result = query($sql);

		if(row_count($result) == 1) {

			$row = fetch_array($result);

			$db_password = $row['password'];
			$first_name = $row['first_name'];

			if(md5($password) === $db_password) {

				if($remember == "on") {

					setcookie('email', $email, time() + 86400);

				}


				$_SESSION['email'] = $email;
				$_SESSION['first_name'] = $first_name;

				return true;

			} else {


				return false;
			}

			return true;

		} else {


			return false;

		}

	} // end of function



/****************logged in function ********************/



function logged_in(){

	if(isset($_SESSION['email']) || isset($_COOKIE['email'])){

		return true;

	} else {

		return false;
	}

}	// functions




/****************Recover Password function ********************/



function recover_password() {


	if($_SERVER['REQUEST_METHOD'] == "POST") {

		if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {

			$email = clean($_POST['email']);


			if(email_exists($email)) {


			$validation_code = md5($email + microtime());


			setcookie('temp_access_code', $validation_code, time()+ 900);


			$sql = "UPDATE users SET validation_code = '".escape($validation_code)."' WHERE email = '".escape($email)."'";
			$result = query($sql);

			$subject = "Please reset your password";
			/*$message =  " Here is your password rest code {$validation_code}

			Click here to reset your password http://edwincodecollege.com/login_app/code.php?email=$email&code=$validation_code

			";*/
			$message = '<html>
							<head>
								<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
								<linl rel="stylesheet" href="../css/recover-email.css" type="text/css" />
							</head>
							<body>
								<div align="center">
								<table class="head-wrap w320 full-width-gmail-android" bgcolor="#f9f8f8" cellpadding="0" cellspacing="0" border="0" width="100%">
								  <tr>
									<td background="https://www.filepicker.io/api/file/UOesoVZTFObSHCgUDygC" bgcolor="#ffffff" width="100%" height="8" valign="top">
									  <div height="8">
									  </div>
									</td>
								  </tr>
								  <tr class="header-background">
									<td class="header container" align="center">
									  <div class="content">
										<span class="brand">
										  <a href="../index.php">
											Studypedia
										  </a>
										</span>
									  </div>
									</td>
								  </tr>
								</table>

								<table class="body-wrap w320">
								  <tr>
									<td></td>
									<td class="container">
									  <div class="content">
										<table cellspacing="0">
										  <tr>
											<td>
											  <table class="soapbox">
												<tr>
												  <td class="soapbox-title">Recovery Code for your account</td>
												</tr>
											  </table>
											  <table class="status-container single">
												<tr>
												  <td class="status-padding"></td>
												  <td>
													<table class="status" bgcolor="#fffeea" cellspacing="0">
													  <tr>
														<td class="status-cell">
														  <label>Recovery code:</label> <center><input type="text" class="form-control" style="width: 80%;" value='.$activation_code.' /></center><!--b>13448278949</b-->
														</td>
													  </tr>
													</table>
												  </td>
												  <td class="status-padding"></td>
												</tr>
											  </table>
											  <table class="body">
												<tr>
												  <td class="body-padding"></td>
												  <td class="body-padded">
													<div class="body-title">Hey '.$email.',</div>
													<table class="body-text">
													  <tr>
														<td class="body-text-cell">
														  Here is your password reset code. if, that does not works then, click the link below to reset your password.
														</td>
													  </tr>
													</table>
													<div style="text-align:left;">
													<a href="http://localhost:8090/Studypedia/code.php?email='.$email.'&code='.$validation_code.'"
													style="background-color:#41CC00;background-image:url(https://www.filepicker.io/api/file/N8GiNGsmT6mK6ORk00S7);border:1px solid #407429;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:17px;font-weight:bold;text-shadow: -1px -1px #47A54B;line-height:38px;text-align:center;text-decoration:none;width:190px;-webkit-text-size-adjust:none;mso-hide:all;">Recover Password</a></div>
													<table class="body-signature-block">
													  <tr>
														<td class="body-signature-cell">
														  <p>Thanks so much,</p>
														  <p class="body-signature">Studypedia Team</p>
														</td>
													  </tr>
													</table>
												  </td>
												  <td class="body-padding"></td>
												</tr>
											  </table>
											</td>
										  </tr>
										</table>
									  </div>
									</td>
									<td></td>
								  </tr>
								</table>

								<table class="footer-wrap w320 full-width-gmail-android" bgcolor="#e5e5e5">
								  <tr>
									<td class="container">
									  <div class="content footer-lead">
										<a href="../contact.php"><b>Get in touch</b></a> if you have any questions or feedback
									  </div>
									</td>
								  </tr>
								</table>
								<table class="footer-wrap w320 full-width-gmail-android" bgcolor="#e5e5e5">
								  <tr>
									<td class="container">
									  <div class="content">
										<a href="../contact.php">Contact Us</a>&nbsp;&nbsp;|&nbsp;&nbsp;
										<span class="footer-group">
										  <a href="#">Facebook</a>&nbsp;&nbsp;|&nbsp;&nbsp;
										  <a href="#">Twitter</a>&nbsp;&nbsp;|&nbsp;&nbsp;
										  <a href="#">Google+</a>
										</span>
									  </div>
									</td>
								  </tr>
								</table>
							  </div>
							</body>
						</html>';

			$headers = "From: noreply@studypedia.com";

			send_email($email, $subject, $message, $headers);

			set_message("<p class='bg-success text-center'>Please check your email or spam folder for a password reset code</p>");

			redirect("index.php");


			} else {


				echo validation_errors("This emails does not exist");

			}

		} else {

			redirect("index.php");

		}

		// token checks

		if(isset($_POST['cancel_submit'])) {

			redirect("login.php");

		}

	} // post request

} // functions




/**************** Code  Validation ********************/


function validate_code () {


	if(isset($_COOKIE['temp_access_code'])) {

			if(!isset($_GET['email']) && !isset($_GET['code'])) {

				redirect("index.php");

			} else if (empty($_GET['email']) || empty($_GET['code'])) {

				redirect("index.php");

			} else {

				if(isset($_POST['code'])) {

					$email = clean($_GET['email']);

					$validation_code = clean($_POST['code']);

					$sql = "SELECT id FROM users WHERE validation_code = '".escape($validation_code)."' AND email = '".escape($email)."'";
					$result = query($sql);

					if(row_count($result) == 1) {

						setcookie('temp_access_code', $validation_code, time()+ 900);

						redirect("reset.php?email=$email&code=$validation_code");

					} else {

						echo validation_errors("Sorry wrong validation code");

					}
		
				}

			}

	} else {

		set_message("<p class='bg-danger text-center'>Sorry your validation cookie was expired</p>");

		redirect("recover.php");

	}

}



/**************** Password Reset Function ********************/


function password_reset() {

	if(isset($_COOKIE['temp_access_code'])) {


		if(isset($_GET['email']) && isset($_GET['code'])) {

			if(isset($_SESSION['token']) && isset($_POST['token'])) {


				if($_POST['token'] === $_SESSION['token']) {


					if($_POST['password']=== $_POST['confirm_password'])  { 


						$updated_password = md5($_POST['password']);


						$sql = "UPDATE users SET password = '".escape($updated_password)."', validation_code = 0 WHERE email = '".escape($_GET['email'])."'";
						query($sql);



						set_message("<p class='bg-success text-center'>You passwords has been updated, please login</p>");

						redirect("login.php");
						

						} else {

							echo validation_errors("Password fields don't match");


						}

				  }

			} 

		} 

	}else {


		set_message("<p class='bg-danger text-center'>Sorry your time has expired</p>");

		redirect("recover.php");

		}

}

function create_notification($for_user_id,$from_module,$message,$link)
{
		$insert_notification = "INSERT into notification(for_user_id,from_module,message,link) VALUES('$for_user_id','$from_module','$message','$link')";
		$isInserted = query($insert_notification);		
}