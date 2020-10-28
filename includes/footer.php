<div class="footer" style="border-top: 1px solid #234a66;">
    	<div class="container">
			<div class="col-md-3 grid_4">
    		   <h3>Our Portal</h3>
    			<ul class="footer_list">
    				<li><a href="about.php">-  About Us </a></li>
    				<li><a href="terms.php">-  Terms and Condition</a></li>
    				<li><a href="privacy.php">-  Privacy Policy</a></li>
    				<li><a href="#" target="_blank">-  Sitemap</a></li>
    			</ul>
    		</div>
    		<!--div class="col-md-3 grid_4">
    		   <h3>About Us</h3>	
    		   <p>Studypedia is web application which provides platform to any individual user to share knowledge and education materials of any subjects and fields and They can share their knowledge through Question-Answers Forum...<a href="about.php">Read More</a></p>
    		      <ul class="social-nav icons_2 clearfix">
                    <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" class="facebook"> <i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                 </ul>
    		</div-->
    		<div class="col-md-3 grid_4">
    		   <h3>Quick Links</h3>
    			<ul class="footer_list">
    				<li><a href="notes.php">-  Notes </a></li>
    				<li><a href="ebook.php?ebook_category=engineering">-  Ebooks</a></li>
    				<li><a href="cem.php?cem_category=GRE">-  Competitive Exam</a></li>
    				<li><a href="forum/index.php" target="_blank">-  Q/A</a></li>
    			</ul>
    		</div>
			<div class="col-md-3 grid_4">
    		   <h3>Contact Us</h3>
    			<address>
                    <strong>Contrary to popular belief</strong>
                    <br>
                    <span>4877 It is a long established</span>
                    <br><br>
                    <span>10880 Malibu Point, 90265</span>
                    <br>
                    <abbr>Telephone : </abbr> +1 (123) 123-4567
                    <br>
                    <abbr>Email : </abbr> <a href="mailto:studypedia@gmail.com">studypedia@gmail.com</a>
               </address>
    		</div>
			<div class="col-md-3 grid_4">
    		   <h3>External Links</h3>
    			<ul class="footer_list">
    				<li><a target="_blank" href="http://www.ets.org/gre/">-  GRE </a></li>
    				<li><a target="_blank" href="https://iimcat.ac.in/">-  CAT</a></li>
    				<li><a target="_blank" href="http://www.mba.com/india">-  MBA</a></li>
    				<li><a target="_blank" href="http://www.gate.iitg.ac.in/">-  GATE</a></li>
    				<li><a target="_blank" href="http://www.upsc.gov.in/">-  UPSC</a></li>
    			</ul>
    		</div>
    		<div class="clearfix"> </div>
			<hr>
    		<div class="copy" style="float: left;">
		       <p>Copyright © 2018 Studypedia . All Rights Reserved</p>
	        </div>
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
					if($user_role == 'Admin')
					{
						echo "<center>
		       <a href='../StudypediaAdmin/index.php' target='_blank'><p>Administrative Control Panel</p></a>
							  </center>";
					}
				}
            ?>
			<ul class="social-nav icons_2 clearfix" style="float: right;">
                    <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" class="facebook"> <i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
            </ul>
    	</div>
    </div>
<!--Scroll to top-->
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
<style>
#return-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: rgb(0, 0, 0);
    background: #f1b458;
    width: 50px;
    height: 50px;
    display: block;
    text-decoration: none;
    -webkit-border-radius: 35px;
    -moz-border-radius: 35px;
    border-radius: 35px;
    display: none;
    -webkit-transition: all 0.3s linear;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
#return-to-top i {
    color: #fff;
    margin: 0;
    position: relative;
    left: 16px;
    top: 13px;
    font-size: 19px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
#return-to-top:hover {
    background: #f1b458;
}
#return-to-top:hover i {
    color: #fff;
    top: 5px;
}
</style>
<script>
// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});
</script>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<!-- Preloader JS -->
<script type="text/javascript" src="js/preloader.js"></script>
</body>
</html>