<?php include("includes/header.php"); ?>
<style>
.col-md-offset-3 {
	margin-left: 30%;
}
.col-md-6 {
	width: 45%;
}
.col-lg-6 {
	width: 45%;
}
.col-lg-offset-3 {
	margin-left: 30%;
}
</style>

<?php include("includes/nav.php"); ?>
<br/>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">	
			<?php validate_user_registration(); ?>
	    </div>
	</div>
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="login.php">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="register.php" class="active" id="">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="register-form" method="post" role="form" >
									<div class="form-group">
										<input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="First Name" value=""   minlength="3" maxlength="20" required />
										<span class="help-block" id="error"></span>
									</div>

									<div class="form-group">
										<input type="text" name="last_name" id="last_name" tabindex="1" class="form-control" placeholder="Last Name"    minlength="3" maxlength="20" value="" required/>
										<span class="help-block" id="error"></span>
									</div>

									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username"  minlength="3" maxlength="20" value="" autocomplete="off" required/>
										<span class="help-block" id="result"></span>
									</div>
									<div class="form-group">
										<input type="email" name="email" id="register_email" tabindex="1" class="form-control" placeholder="Email Address" value="" required/>
										<span class="help-block" id="resultEmail"></span>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password"  minlength="8" required/>
										<span class="help-block" id="error"></span>
									</div>
									<div class="form-group">
										<input type="password" name="confirm_password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password"  minlength="8" required/>
										<span class="help-block" id="error"></span>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now" />
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<span>Already have an Account?&nbsp;</span>
													<a href="login.php" tabindex="5">Log In</a>
												</div>
											</div>
										</div>
									</div>
									
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/register.js"></script>
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
<script type="text/javascript">
	function usernameCheck(){
		var name = $(this).val(); 
  
  if(name.length > 2)
  {  
   $("#result").html('checking...');
   
   /*$.post("username-check.php", $("#register-form").serialize())
    .done(function(data){
    $("#result").html(data);
   });*/
   
   $.ajax({
    
    type : 'POST',
    url  : 'username-check.php',
    data : $(this).serialize(),
    success : function(data)
        {
              $("#result").html(data);
           }
    });
    return false;
   
  }
  else
  {
   $("#result").html('');
  }
	}
$(document).ready(function()
{    
 $("#username").keyup(usernameCheck);
 
 	$("#register_email").keyup(function()
 {  
	var name = $(this).val(); 
  
  if(name.length > 2)
  {  
   $("#resultEmail").html('checking...');
   
   /*$.post("username-check.php", $("#reg-form").serialize())
    .done(function(data){
    $("#result").html(data);
   });*/
   
   $.ajax({
    
    type : 'POST',
    url  : 'email-check.php',
    data : $(this).serialize(),
    success : function(data)
        {
              $("#resultEmail").html(data);
           }
    });
    return false;
   
  }
  else
  {
   $("#resultEmail").html('');
  }
 });
 });
</script>
<?php include("includes/footer.php") ?>