<?php include("includes/header.php") ?>
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
<?php 

	if(logged_in()) {

		redirect("logged_in.php");

	}


 ?>

  
  <?php include("includes/nav.php") ?>
<br/>	

	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			
			<?php display_message(); ?>

			<?php validate_user_login(); ?>
		
								
		</div>
	</div>
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="login.php" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="register.php" id="">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form"  method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" autocomplete="off" required>
										<span class="help-block" id="error"></span>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="login-
										password" tabindex="2" class="form-control" placeholder="Password" required>
										<span class="help-block" id="error"></span>
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="recover.php" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<span>Don't have an Account?&nbsp;</span>
													<a href="register.php" tabindex="5">Register</a>
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
		<script src="js/loginvalidation.js"></script>
	<?php include("includes/footer.php") ?>