	<div class="banner">
			<!-- banner Slider starts Here -->
					<script src="js/responsiveslides.min.js"></script>
					 <script>
						// You can also use "$(window).load(function() {"
						$(function () {
						  // Slideshow 4
						  $("#slider3").responsiveSlides({
							auto: true,
							pager: true,
							nav: true,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });
					
						});
					  </script>
					<!--//End-slider-script -->
					<div id="top" class="callbacks_container">
						<ul class="rslides" id="slider3">
							<li>
								<div class="banner-bg banner-img">
									<div class="container">
										<div class="banner-info">
											<h3>Join our Community <br/>and Study Smart</h3><br/>
											<a href="login.php"><i class="fa fa-sign-in" style="font-size: 20px; transition: color 0.2s ease 0s, border-color 0.2s ease 0s, background-color 0.2s ease 0s; min-height: 0px; min-width: 0px; line-height: 20px; border-width: 0px 2px 0px 0px; margin: 0px; padding:0px 10px 0 0; letter-spacing: 0px;"></i>Login</a>&nbsp;&nbsp;&nbsp;&nbsp;
											<a href="register.php"><i class="fa fa-user-plus" style="font-size: 20px; transition: color 0.2s ease 0s, border-color 0.2s ease 0s, background-color 0.2s ease 0s; min-height: 0px; min-width: 0px; line-height: 20px; border-width: 0px 2px 0px 0px; margin: 0px; padding:0px 10px 0 0; letter-spacing: 0px;"></i>Sign Up</a>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="banner-bg">
									<div class="container">
										<div class="banner-info">
											<h3>you will get everything <br/>at one Place</h3><br/>
											<a href="notes.php"><i class="fa fa-file-text-o" style="font-size: 20px; transition: color 0.2s ease 0s, border-color 0.2s ease 0s, background-color 0.2s ease 0s; min-height: 0px; min-width: 0px; line-height: 20px; border-width: 0px 2px 0px 0px; margin: 0px; padding:0px 10px 0 0; letter-spacing: 0px;"></i>Notes</a>&nbsp;&nbsp;&nbsp;&nbsp;
											<a href="ebook.php"><i class="fa fa-file-pdf-o" style="font-size: 20px; transition: color 0.2s ease 0s, border-color 0.2s ease 0s, background-color 0.2s ease 0s; min-height: 0px; min-width: 0px; line-height: 20px; border-width: 0px 2px 0px 0px; margin: 0px; padding:0px 10px 0 0; letter-spacing: 0px;"></i>E-Books</a>
										</div>
									</div>
								</div>
							</li>
						</ul>
		          </div>
	</div>	
	