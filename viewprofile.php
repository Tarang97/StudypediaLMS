<?php
      include("includes/header.php");
      include("includes/nav.php"); 
?>
<html>
<head>
  <script type="text/javascript">
      function checkPass(){
        var password = document.getElementById("password");
        var confirm_password = document.getElementById("confirm_password");
        var error_confirm_password = document.getElementById("error_confirm_password");
        if(password.value != confirm_password.value)
        {
            error_confirm_password.innerHTML = "<span style='color:red;'>Confirm Password does not match to Password field.</span>";
            confirm_password.style.borderColor = "red";
            confirm_password.focus();
            return false;
        }
        return true;
      }
      </script>
</head>
<body>
  <div class="container">
    <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
      
      <?php display_message(); ?>

      <?php validate_user_login(); ?>
               
    </div>
	</div>
  </div>
  <?php
  $user_email = $_SESSION['email'];

  $user_details_sql = "SELECT id,first_name,last_name,password FROM users WHERE email = '$user_email'";

  $user_details_result = query($user_details_sql);

  foreach ($user_details_result as $temp) {
    $user_first_name = $temp['first_name'];
    $user_last_name = $temp['last_name'];
    $user_password = $temp['password'];
    $user_id = $temp['id'];
  }
  
  $result_notes = array();
  $notes_sql = "SELECT * FROM notes WHERE uploaded_by_userid = '$user_id'";
  $notes_result1 = query($notes_sql);
  foreach ($notes_result1 as $temp) {
      $result_notes[] = $temp;
  }

  //fetch competitive exam material uploaded by user
  $result_cem = array();
  $cem_sql = "SELECT * FROM competitive_exam WHERE cem_uploaded_by_userid = '$user_id'";
  $cem_result1 = query($cem_sql);
  foreach ($cem_result1 as $temp) {
    $result_cem[] = $temp;
  }

?>
<?php if(logged_in()):?>
<section>

<div class="container" style="margin-top: 30px;">
<div class="profile-head">
<div class="col-md-4 col-sm-4 col-xs-12">
<h2><?php echo $user_first_name.' '.$user_last_name; ?></h2>
</div>          <!--col-md-4 col-sm-4 col-xs-12 close-->
</div><!--profile-head close-->
</div><!--container close-->


<div id="sticky" class="container">
    
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-menu" role="tablist">
      <li class="active">
          <a href="#profile" role="tab" data-toggle="tab">
              <i class="fa fa-male"></i> Profile
          </a>
      </li>
      <li>
		<a href="#change" role="tab" data-toggle="tab">
          <i class="fa fa-edit"></i> Edit Profile
          </a>
      </li>
    </ul><!--nav-tabs close-->
    
    <!-- Tab panes -->
<div class="tab-content">
  
<div class="tab-pane fade active in" id="profile" class="profile_div">
<div class="container">
<br clear="all" />
<div class="row">

<div class="col-md-12">

<div class="table-responsive responsiv-table">
  <table class="table bio-table">
      <tbody>
     <tr>      
        <td style="width:20%">Firstname</td>
        <td><?php echo $user_first_name; ?></td> 
     </tr>
     <tr>    
        <td style="width:20%">Lastname</td>
        <td><?php echo $user_last_name; ?></td>       
     </tr>
     <tr>  
        <td style="width:20%">Emai Id</td>
        <td><?php echo $user_email; ?></td> 
     </tr>
    </tbody>
  </table>
  </div><!--table-responsive close-->
</div><!--col-md-12 close-->
</div><!-- close 'row' division-->

<div class="row">

<h3>Study Material Uploaded By <?php echo $user_first_name; ?></h3>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-menu" role="tablist">
      <li class="active">
          <a href="#notes_uploaded" role="tab" data-toggle="tab">
        Notes
          </a>
      </li>
      <li><a href="#cem_uploaded" role="tab" data-toggle="tab">
        Competitive Exam Material
          </a>
      </li>
    </ul><!--nav-tabs close-->
  
  <!-- For uploaded notes-->
<div class="tab-content">

    <div class="tab-pane fade active in" id="notes_uploaded">
    <div class="container">
    <br clear="all" />
	<div class="row">
	<?php if (sizeof($result_notes) == 0) : ?>
	<?php echo "You haven't uploaded any Notes Yet."; ?>
	<?php else: ?>
	<table class="table table-striped table-hover">
	<tbody>
                      <tr>
                          <th>Title</th>
                          <th>Subject</th>
                          <th>Field</th>
                          <th>Topics</th>
                          <th>Description</th>
                          <th>Uploaded On</th>
                          <th></th>
                          <th></th>
                      </tr>
                      <?php 
                        foreach ($result_notes as $row)
                        {
                          echo  "<tr>";
                            echo "<td>".$row['title']."</td>";
                            echo "<td>".$row['subject']."</td>";
                            echo "<td>".$row['field']."</td>";
                            echo "<td>".$row['topics']."</td>";
                            echo "<td>".$row['description']."</td>";
                            echo "<td>".$row['date']."</td>";
                            echo "<td><a class='btn btn-warning' href='edit_file.php?filetype=notes&file_id= ".$row['note_id']." '>Edit File</a></td>";
                            echo "<td><a class='btn btn-danger' href='delete_from_profile.php?filetype=notes&note_id= ".$row['note_id']." &file_path= ".$row['file_path']." '>Delete</a></td>";
                          echo "</tr>";
                        }
                    ?>
	</tbody>
	</table>
	<?php endif ?>
	</div><!-- close row for notes_uploaded-->
	</div><!-- close container for notes_uploaded-->
	</div><!-- close notes_uploaded div-->
      
<!-- For uploaded cem-->
    <div class="tab-pane fade" id="cem_uploaded">
    <div class="container">
    <br clear="all" />
	<div class="row">
	<?php if (sizeof($result_cem) == 0) : ?>
	<?php echo "You haven't uploaded any Competitive Exam Material Yet."; ?>
	<?php else: ?>
	<table class='table table-striped table-hover'>
	<tbody>
      <tr>
                        <th>Name</th>
                        <th>Authors</th>
                        <th>Exams</th>
                        <th>Topics</th>
                        <th>Description</th>
                        <th>Uploaded Date</th>
                        <th></th>
                        <th></th>
      </tr>
      <?php 
                      foreach ($result_cem as $row)
                      {
                        echo  "<tr>";
                        echo "<td>".$row['cem_name']."</td>";
                        echo "<td>".$row['cem_authors']."</td>";
                        echo "<td>".$row['cem_exams']."</td>";
                        echo "<td>".$row['cem_topics']."</td>";
                        echo "<td>".$row['cem_description']."</td>";
                        echo "<td>".$row['cem_uploaded_on']."</td>";
                        echo "<td><a class='btn btn-warning' href='edit_file.php?filetype=cem&file_id= ".$row['cem_id']." '>Edit File</a></td>";
                        echo "<td><a class='btn btn-danger' href='delete_from_profile.php?filetype=cem&cem_id= ".$row['cem_id']." &cem_file_path= ".$row['cem_file_path']." '>Delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
	</tbody>
	</table>
	<?php endif ?>
	</div><!-- close row for cem_uploaded-->
	</div><!-- close container for cem_uploaded-->
	</div><!-- close cem_uploaded div-->
  <a class='btn btn-info' href='reported_file_details.php'>Your Reported Files</a>
  <a class='btn btn-info' href='suggestedits_file_details.php'>Suggestions To You</a>
</div><!-- close tab-content for cem_uploaded-->

</div><!-- close row for profile-->
</div><!--container close for profile-->
</div><!-- close profile div-->

<div class="tab-pane fade" id="change">
<div class="container form-main">
<div class="row">

<form class="form-horizontal main_form text-left" action="edit_profile_process.php" method="post"  id="edit_profile_form"  onsubmit="return checkPass()">
<fieldset>

<div class="form-group col-md-12">
  <label class="col-md-2 control-label">First Name</label>  
  <div class="col-md-4 inputGroupContainer">
		<div class="input-group">
			<input  name="first_name" placeholder="First Name" class="form-control"  minlength="3" maxlength="20" type="text" value=<?php echo $user_first_name; ?>>
		</div>
  </div>
  <div  class="col-md-6">
		<span class="help-block">Minimum 3 characters and maximum 20 characters</span>
  </div>
</div><!-- Close Division for first name -->

<!-- Text input-->
<div class="form-group col-md-12">
  <label class="col-md-2 control-label">Last Name</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <input  name="last_name" placeholder="Last Name" class="form-control"  minlength="3" maxlength="20" type="text" value=<?php echo $user_last_name; ?>>
    </div>
  </div>
  <div  class="col-md-6">
  <span class="help-block">Minimum 3 characters and maximum 20 characters</span>
  </div>
</div><!-- Close Division for last name -->

<!-- Text input-->
<div class="form-group col-md-12">
  <label class="col-md-2 control-label">Email</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <input  name="email" placeholder="Email" class="form-control"  type="text" value=<?php echo $user_email; ?>>
    </div>
  </div>
  <div  class="col-md-6">
  <span class="help-block">ex.abc@gmail.com</span>
  </div>
</div><!-- Close Division for Email -->

<div class="form-group col-md-12">
  <label class="col-md-2 control-label">Change Password</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <input  name="password" id="password" placeholder="Change Password" class="form-control"  type="password" minlength="8">
    </div>
  </div>
  <div  class="col-md-6">
  <span class="help-block">Password must contains minimum 8 characters</span>
  </div>
</div><!-- Close Division for Change Password -->

<div class="form-group col-md-12">
  <label class="col-md-2 control-label">Confirm Password</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <input  name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control"  minlength="8" type="password">
  </div>
  </div>
  <div class="col-md-6" id="error_confirm_password">
  <span class="help-block">Confirm Password must same as Password field</span>
  </div>
</div><!-- Close Division for Confirm Password -->

<!-- Button -->
<div class="form-group col-md-10">
<div class="col-md-3"></div>
  <div class="col-md-6">
    <button type="submit" class="btn btn-warning submit-button">Save</button>
    <button type="reset" class="btn btn-info" >Reset</button>
  </div>
<div class="col-md-3"></div>
</div><!-- Close Division for Both Buttons-->

</fieldset>
</form>

</div><!--row close-->
</div><!--container close -->          
</div><!--tab-pane close-->

</div><!--tab-content close-->


</div><!--sticky container close-->
<?php endif; ?>
	<?php if(logged_in() == false): ?>
	<?php redirect("403.php") ?>
	<?php endif; ?>
</section><!--section close-->

</body>
</html>
<?php include("includes/footer.php") ?>