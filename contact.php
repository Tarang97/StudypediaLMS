<?php include('includes/header.php') ?>
<link href="css/contact.css" rel='stylesheet' type='text/css' />
<link href="css/iconmoon.css" rel='stylesheet' type='text/css' />
<?php include('includes/nav.php') ?>
<?php
	//if(!(isset($_SESSION["a"]))) {
	//$a=rand(1,50);
	//$b=rand(1,50);
	
	//$_SESSION["a"]=$a;
	//$_SESSION["b"]=$b;
	
	//}
$email = '';
$message = '';
$name ='';
$subject ='';
$result ='';
$error ='';

if(isset($_POST['submit'])){
      // echo '<h1>Submit Clicked !!!! '.$_POST['submit'].'</h1>';
        $name = $_POST['name'];
        $email = $_POST['email'];
		$subject=$_POST['subject'];
        $message = $_POST['message'];
        //$check = intval($_POST['secCheck']);
    
        /*if(!$_POST['name']){ $error .= 'Please enter your name! <br>'; }
        if(!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ $error .= 'Please enter your email! <br>'; }
        if(!$_POST['subject']){ $error .= 'Please enter your subject! <br>'; }
		if(!$_POST['message']){ $error .= 'Please enter a message! <br>'; }*/
        //if($check !== ($_SESSION["a"] + $_SESSION["b"])){ $error .= 'Wrong AntiSpam value <br>'; }
		
if($error == ''){
    $from = $email;
    $to =   'studypedia@gmail.com'; // email that you want to receive the email to. YOUR ADDRESS
    $subject = 'Message for Studypedia';
    $body = "From: $name ($email) \n Message \n $message";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <'.$from.'>' . "\r\n";  
    if(mail($to,$subject,$body,$headers)){
     $result = '<div class="alert alert-success">Mail Sent, We will Contact you Soon.</div>';  
        }else{
               $result = '<div class="alert alert-danger alert-dismissible">Mail wasn\'t sent</div>';    
        }
    $email = '';
    $message = '';
    $name ='';
	$subject ='';
    
    // Send email
} else {
    $result = '<div class="alert alert-danger alert-dismissible"><strong>Error Found:</strong><br><span class="closebtn">'.$error.'</span></div>';
}
    }
?>
<style>
	.text-danger {
		display:none;
	}
</style>

	<div class="features" style="padding: 2em 0;">
	   <div class="container">
	   	  <h1>How to find us</h1>
		  <hr>
		 <form class="contact_form" id="contact-form" method="post" action="contact.php" autocomplete="off">
		 	<h2>Contact form</h2>
			<div class="col-md-6 grid_6">
			<div class="form-group">
				<input type="text" class="text" value="<?php echo $name;?>" name="name" placeholder="Name" />
				<span class="help-block" id="error"></span>
			</div>
			<div class="form-group">
				<input type="text" class="text" value="<?php echo $email;?>" name="email" placeholder="Email" />
				<span class="help-block" id="error"></span>
			</div>
			<div class="form-group">
				<input type="text" class="text" value="<?php echo $subject;?>" name="subject" placeholder="Subject" />
				<span class="help-block" id="error"></span>
			</div>
			<div class="form-group">
				<textarea value="Message" name="message" placeholder="Message"><?php echo $message;?></textarea>
			</div>
				<div class="g-recaptcha" data-sitekey="6LdDHVAUAAAAAPmJ0OqMSKiWzE5mfBhcglu8qEuo"></div>
				<br/>
				<!--<label for="secCheck" class="col-sm-2 control-label"><?php //echo $_SESSION["a"].'+'.$_SESSION["b"] ?></label>-->
				<!--<input type="text" class="text" id="secCheck" name="secCheck" placeholder="Answer" />
				<p class="text-danger">Answer the Question Above</p>-->
				<div class="row">
					<div class="col-sm-12">
					  <button class="btn" id="submit" name="submit">Send Message <span class="fa fa-play-circle-o" aria-hidden="true"></span></button>
					  <div class="msg"></div>
					</div>
				  </div>
			</div>
			<!-- Start Location Tag -->
			<div class="container">	
			<div class="col-md-6 grid_6">				  
					<div class="contact-detail">
					  <div class="address">
						<div class="inner">
						  <h3>Studypedia</h3>
						  <p>10880 Malibu Point, 90265,<br/> California, USA</p>
						</div>
						<div class="inner">
						  <h3>000 0000 000</h3>
						</div>
						<div class="inner"> <a href="mailto:info@studypedia.com">info@studypedia.com</a> </div>
					  </div>
					  <div class="contact-bottom">
						<ul class="follow-us">
						  <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
						  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
						  <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
						  <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					  </div>
					</div>
				  
				<div class="form-group">
                        <div class="text" style="padding-top:20px";>
                            <?php //echo $result; ?>
							<?php //$response = isset($_POST['response']) ? $_POST['response'] : ''; ?>
							<?php //echo $response; ?>
							<?php
								if($_SERVER['REQUEST_METHOD'] == "POST") {
									$name = $_POST['name'];
									$secretKey = "6LdDHVAUAAAAALzTQYxqj50CpQn7x7eT8a1CEnbz";
									$responseKey = $_POST['g-recaptcha-response'];
									$userIP = $_SERVER['REMOTE_ADDR'];
									
									$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";		
									$response = file_get_contents($url);
									$response = json_decode($response);
									if($response->success)
										echo "<div class='alert alert-success alert-dismissible'>
							  <span class='closebtn'>&times;</span>  
							  Verification<strong>Successful!</strong>
							</div>";
									else
										echo "<div class='alert alert-danger alert-dismissible'>
							  <span class='closebtn'>&times;</span>  
							  Verification<strong>Failed!</strong>
							</div>";
								}
							 ?>
                        </div>
				</div>
			</div>
			</div>
			<!-- End Location Tag -->
		 </form>
							
		<hr>				
	  </div>
	</div>
	<!-- Start Have Questions -->

<section class="our-impotance have-question padding-lg">
  <div class="container">
    <h2>Still have questions?</h2>
    <ul class="row">
      <li class="col-sm-4 equal-hight">
        <div class="inner"> <img src="images/help-center-ico.jpg" alt="Malleable Study Time">
          <h3>Help Center</h3>
          <p>Study material available online 24/7. Study in your free time, no time management issues, perfect balance between work and study time.</p>
        </div>
      </li>
      <li class="col-sm-4 equal-hight">
        <div class="inner"> <img src="images/faq-ico.jpg" alt="Placement Assistance">
          <h3>Faq’s</h3>
          <p>Studypedia Online has access to all of studypedia Group’s placement resources and alumni network, through which thousands of job opportunities are generated.</p>
        </div>
      </li>
      <li class="col-sm-4 equal-hight">
        <div class="inner"> <img src="images/document-ico.jpg" alt="Easy To Access">
          <h3>Technical Documents</h3>
          <p>There is easy accessibility to online help in terms of online teachers and online forums. Teachers can be contacted with the help of video chats and e-mails.</p>
        </div>
      </li>
    </ul>
  </div>
</section>

<!-- End Have Questions -->
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/contact.js"></script>
	<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}
</script>
<?php include('includes/footer.php') ?>	