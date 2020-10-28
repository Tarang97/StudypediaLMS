<?php include("functions/db_details.php"); ?>
<?php
  $dbcon = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
  
  if($_POST) 
  {
      $username     = strip_tags($_POST['username']);
      
   $stmt=$dbcon->prepare("SELECT username FROM users WHERE username=:name");
   $stmt->execute(array(':name'=>$username));
   $count=$stmt->rowCount();
      
   if($count>0)
   {
    echo "<span style='color:brown;'>Sorry username already exist !!!</span>";
   }
   else
   {
    echo "<span style='color:green;'>Available</span>";
   }
  }
?>