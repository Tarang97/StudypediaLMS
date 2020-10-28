<?php include("includes/header.php") ?>
  <?php include("includes/nav.php") ?>
  <?php //include 'subscribers.php'; ?>
  <?php display_message(); ?>
   <?php include("includes/banner.php") ?>
<html>
	<head>
	<script type="text/javascript">
	$(document).ready(function() {
    $('#Carousel').carousel({
        interval: 5000
    })
});
	</script>
	<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();   
	});
	</script>
	<link href="css/indexpage.css" rel="stylesheet" type="text/css">
	</head>
<!-- Start About Section -->
&nbsp;
<section class="about">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-sm-push-0 left-block"> <span class="sm-head">the Online Study portal</span>
        <h2>Studypedia</h2>
        <p>Building on Studypedia Group’s rich experience with providing any material related to topic or subjects at Studypedia Online! Designing and delivering both graduate and post-graduate programs across a variety of disciplines, Studypedia Online, offering help to find everything at one place has worked upon the knowledge-base created by our highly qualified faculties, our research, publishing and knowledge experience, to create this portal that offer a rich learning experience.</p>
        <div class="know-more-wrapper"> <a href="about.php" class="know-more">Know More&nbsp; <i class="fa fa-arrow-circle-right"></i></a> </div>
      </div>
    </div>
  </div>
</section>
<hr style='border: 0; 
  height: 1px; 
  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);'>
<!-- End About Section -->
<br/>
<!-- Start Cources Section -->
<section class="our-cources padding-lg">
<div class="container">
	<h2> <span>Unique Features of our Portal</span> What do you want to study?</h2>
    <div class="row">
		<div class="col-md-12">
                <div id="Carousel" class="carousel slide">
                 
                <ol class="carousel-indicators">
                    <li data-target="#Carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#Carousel" data-slide-to="1"></li>
                    <li data-target="#Carousel" data-slide-to="2"></li>
                </ol>
                 
                <!-- Carousel items -->
                <div class="carousel-inner">
                    
                <div class="item active">
                	<div class="row">
                	  <div class="col-md-3"><a href="notes.php" class="thumbnail"><img src="images/notes.jpg" alt="Notes" style="max-width:100%;" data-toggle="tooltip" data-placement="top" title="Notes"/></a></div>
					  <div class="col-md-3"><a href="ebook.php?ebook_category=engineering" class="thumbnail"><img src="images/engineering.png" alt="Engineering" style="max-width:100%;"data-toggle="tooltip" data-placement="top" title="Engineering" /></a></div>
                	  <div class="col-md-3"><a href="ebook.php?ebook_category=mba" class="thumbnail"><img src="images/mba.png" alt="Mba" style="max-width:100%;" data-toggle="tooltip" data-placement="top" title="MBA" /></a></div>
                	  <div class="col-md-3"><a href="ebook.php?ebook_category=medical" class="thumbnail"><img src="images/medical.jpg" alt="Medical" style="max-width:100%;" data-toggle="tooltip" data-placement="top" title="Medical" /></a></div>
                	  
                	</div><!--.row-->
                </div><!--.item-->
                 
                <div class="item">
                	<div class="row">
						<div class="col-md-3"><a href="ebook.php?ebook_category=Commerce" class="thumbnail"><img src="images/commerce.jpg" alt="Commerce" style="max-width:100%;" data-toggle="tooltip" data-placement="top" title="Commerce" /></a></div>
                		<div class="col-md-3"><a href="cem.php?cem_category=GRE" class="thumbnail"><img src="images/gre.png" alt="Gre" style="max-width:100%;" data-toggle="tooltip" data-placement="top" title="GRE" /></a></div>
                		<div class="col-md-3"><a href="cem.php?cem_category=GATE" class="thumbnail"><img src="images/gate.png" alt="Gate" style="max-width:100%;" data-toggle="tooltip" data-placement="top" title="GATE" /></a></div>
                		<div class="col-md-3"><a href="cem.php?cem_category=CAT" class="thumbnail"><img src="images/cat.png" alt="CAT" style="max-width:100%;" data-toggle="tooltip" data-placement="top" title="CAT" /></a></div>
                		
                	</div><!--.row-->
                </div><!--.item-->
                 
                <div class="item">
                	<div class="row">
						<div class="col-md-3"><a href="cem.php?cem_category=UPSC" class="thumbnail"><img src="images/upsc.jpg" alt="Upsc" style="max-width:100%;" data-toggle="tooltip" data-placement="top" title="UPSC" /></a></div>
                		<div class="col-md-3"><a href="cem.php?cem_category=GMAT" class="thumbnail"><img src="images/gmat.png" alt="Gmat" style="max-width:100%;" data-toggle="tooltip" data-placement="top" title="GMAT" /></a></div>
                		<div class="col-md-3"><a href="cem.php?cem_category=GPSC" class="thumbnail"><img src="images/gpsc.png" alt="Gpsc" style="max-width:100%;" data-toggle="tooltip" data-placement="top" title="GPSC" /></a></div>
                		<div class="col-md-3"><a href="forum/index.php" target="_blank" class="thumbnail"><img src="images/q_a.png" alt="Q&A" style="max-width:100%;" data-toggle="tooltip" data-placement="top" title="Forum" /></a></div>
                	</div><!--.row-->
                </div><!--.item-->
                 
                </div><!--.carousel-inner-->
                  <a data-slide="prev" href="#Carousel" class="left carousel-control">‹</a>
                  <a data-slide="next" href="#Carousel" class="right carousel-control">›</a>
                </div><!--.Carousel-->
                 
		</div>
	</div>
</div><!--.container-->
</section>
<hr style='border: 0; 
  height: 1px; 
  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);'>

<!-- Start Our Importance Section -->

<section class="our-impotance padding-lg">
  <div class="container">
    <ul class="row">
      <li class="col-sm-4 equal-hight">
        <div class="inner"> <img src="images/study-time-ico.jpg" alt="Malleable Study Time">
          <h3>Malleable Study Time</h3>
          <p>Study material available online 24/7. Study in your free time, no time management issues, perfect balance between work and study time.</p>
        </div>
      </li>
      <li class="col-sm-4 equal-hight">
        <div class="inner"> <img src="images/placement-ico.jpg" alt="Placement Assistance">
          <h3>Placement Assistance</h3>
          <p>Studypedia has access to all of studypedia Group’s placement resources and alumni network, through which thousands of job opportunities are generated.</p>
        </div>
      </li>
      <li class="col-sm-4 equal-hight">
        <div class="inner"> <img src="images/easy-access-ico.jpg" alt="Easy To Access">
          <h3>Easy To Access</h3>
          <p>There is easy accessibility to online help in terms of online teachers and online forums. Teachers can be contacted with the help of e-mails.</p>
        </div>
      </li>
      <li class="col-sm-4 equal-hight">
        <div class="inner"> <img src="images/study-go-ico.jpg" alt="Study on the Go">
          <h3>Study on the Go</h3>
          <p>Our Site is easily accessible anywhere on any devices. Availability of ready reckoners such that students can remember the key points of the session learnt.</p>
        </div>
      </li>
      <li class="col-sm-4 equal-hight">
        <div class="inner"> <img src="images/get-innovative-ico.jpg" alt="Get an Innovative, In-depth Transition">
          <h3>Get an Innovative, <span>In-depth Transition</span></h3>
          <p>The transition to an environment of learning becomes easy with the availability of multiple sources of learning such as text books, power-point presentations, and story boards on various subjects.</p>
        </div>
      </li>
      <li class="col-sm-4 equal-hight">
        <div class="inner"> <img src="images/practical-ico.jpg" alt="Practical & Interactive Participation">
          <h3>Practical & Interactive <span>Participation</span></h3>
          <p>Assessments and interactivities are given at the end of every session such that the practical application of theory learnt can be gauged.</p>
        </div>
      </li>
    </ul>
  </div>
</section>
<hr style='border: 0; 
  height: 1px; 
  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);'>
<!-- End Our Importance Section -->
<!--Subscribe News Letter-->
<div class="intro-header"> 
<div class="container"  align="center">

<div class="tab-content custom-tab-content" align="center">
<div class="subscribe-panel">
<h1>Newsletter!!!</h1>
<p>Subscribe to our weekly Newsletter and stay tuned.</p>
&nbsp;
&nbsp;                
                <!--form action="subscribe.php" method="post">                    	
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<div class="form-group">									
									<input type="text" class="form-control input-lg" name="email" id="email"  placeholder="Enter your Email Address" autocomplete="off" data-toggle="tooltip" data-placement="top" title="Email to get Subscribe " required/>
								</div>
							</div>
							<div class="col-md-4"></div>
                    <br/><br/><br/-->
					<?php 
					if(logged_in()) {
						echo "<div id='subscribe-form'>
							<div class='col-md-4'></div>
							<div id='error' style='color:red;font-weight:bold;'></div>
							<div id='success'style='color:green;font-weight:bold;'></div>
              <!--form  id='subscriberForm' method='POST' class='form-control-static'-->
							<div class='col-md-4 form-inline'>
								<div class='form-group'>
								  <input type='text' class='form-control' id='name' placeholder='Enter name' name='name' autocomplete='off' data-toggle='tooltip' data-placement='top' title='Name to get Subscribe ' required/>
								</div>&nbsp;&nbsp;
								<div class='form-group'>									
									<input type='email' class='form-control' name='email' id='email'  placeholder='Enter your Email Address' autocomplete='off' data-toggle='tooltip' data-placement='top' title='Email to get Subscribe ' required />
								</div><br/>
							</div>
              <!--/form-->
							<div class='col-md-4'></div>
                    <br/><br/><br/>
					<button class='btn btn-warning btn-lg' data-toggle='tooltip' data-placement='top' title='Click to Subscribe' name='submit' onClick='validate()'>Subscribe Now!</button>
					
					</div>";
					}
					else {
						echo "<div id='subscribe-form'>                    	
							<div class='col-md-4'></div>
							<div class='col-md-4 form-inline'>
								<div class='form-group'>
								  <input type='text' class='form-control' id='name' placeholder='Enter name' name='name' autocomplete='off' data-toggle='tooltip' data-placement='top' title='Name to get Subscribe ' required/>
								</div>&nbsp;&nbsp;
								<div class='form-group'>									
									<input type='email' class='form-control' name='email' id='email'  placeholder='Enter your Email Address' autocomplete='off' data-toggle='tooltip' data-placement='top' title='Email to get Subscribe ' required />
								</div>
							</div>
							<div class='col-md-4'></div>
                    <br/><br/><br/>
					<button class='btn btn-warning btn-lg' data-toggle='tooltip' data-placement='top' title='Click to Subscribe' onClick='myFunction()'>Subscribe Now!</button>
					
					</div>";
					}
					?>
                    <!--button class='btn btn-warning btn-lg' data-toggle='tooltip' data-placement='top' title='Click to Subscribe'>Subscribe Now!</button-->
              

</div>
</div>
</div>
</div>
<script>
function myFunction() {
	alert("Please Register or Login to subscribe for Newsletter!");
}
</script>
<script>
function validate() {
  var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
  if($("#name").val() == "")
  {
    alert("Please Enter Your Name");
  }
  else if($("#email").val() == "")
  {
   alert("Please Enter Your Email Address"); 
  }
  else if(!pattern.test($("#email").val()))
  {
    alert("Email Address is not valid");
  }
	if(window.XMLHttpRequest)
	{
		xmlhttp = new window.XMLHttpRequest();
	}
	else {
		xmlhttp = new ActiveXObject('Microsoft',XMLHTTP);
	}
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readystate == '4' && xmlhttp.status == '200') {
			if(xmlhttp.responseText == 'Subscribed Successfully') {
				document.getElementById('success').innerHTML = xmlhttp.responseText;
				alert("Subscribed Successfully");
			}
			else {
				document.getElementById('error').innerHTML = xmlhttp.responseText;
			}
		}
	}
	name = document.getElementById('name').value;
	email = document.getElementById('email').value;
	
	parameters = 'name='+name+'&email='+email;
	
	xmlhttp.open('POST','subscribers.php', true);
	xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xmlhttp.send(parameters);
}
</script>
<?php include("includes/footer.php") ?>