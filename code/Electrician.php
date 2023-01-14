<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link rel="stylesheet" href="styl.css">
    <link rel="stylesheet" href="ele.css">
   
  

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Electrician</title>
</head>
<body>   <?php
require('session.php');
?><nav>
         <label class="logo">Home care Services</label>
         <ul>

         <li><a href="index.php">Home</a></li>

<li><a href="about.php">about</a></li>

            <li>
               <a href="#">Services
               <i class="fas fa-caret-down"></i>
               </a>
               <ul>
                  <li><a href="Painters.php">Painters</a></li>
                  <li><a href="Electrician.php">Electrician</a></li>
                  <li><a href="Cook.php">Cook</a></li>               
                 <li><a href="Homecleaners.php">Homecleaners</a></li>
                 </ul>
                 </li>
                 <li><a href='<?php
                  if(isset($_SESSION['worker']))
                 {echo "services.php"; }
                 else{
                   echo "cust_services.php";} ?>'>Request status</a></li>
                 <li><a href="logout.php">Logout</a></li>
                 <!-- <li><a href="login.php">login</a></li>
                 <li><a href="register.php">registration</a></li> -->
               <!-- <li><a href="contact.php">Contact</a></li> -->
               </ul>
      </nav>
    <div class='painter'>
        
   <h1 align='center' class='py-5 head' >
  <span >E</span>
  <span>L</span>
  <span >E</span>
  <span >C</span>
  <span >T</span>
  <span >R</span>
  <span >I</span>
  <span>C</span>
  <span >A</span>
  <span >N</span>




</h1>
      <h3 align='center' style='color:blue;'class='subhead'>The Electricians are the ones who bring light to our home and life</h3>
    </div>
    <div class='table my-5'>
        <h3 align='center'>The Electricians available</h3>


<?php
        require('../db_connect/database.php');
        
		$sql1="SELECT * FROM `worker` where `worker_cat`='2'";
    $result = $conn->query($sql1);
    if($result->num_rows>0)//when db records are found store in associative array...
       {
     // output data of each row
   
 echo '<div class="row"> ';
   while($row = $result->fetch_assoc())
    {
     $sql="SELECT `ratings` FROM `rating_table` where `customer_id`=".$row['worker_id'];
     $result1 =$conn->query($sql);
     $count=0;
     $sum=0;
     $star=0;
     if($result->num_rows>0)//when db records are found store in associative array...
       {
     while($row1= $result1->fetch_assoc()){
       $sum+=$row1['ratings'];
       $count=$count+1;
     }
   if($count>0){
     $star=$sum/$count;
     $star=round($star,1);
     $star=$star." star worker";
    }
    else{
     $star="no reviews yet";
    }
}
echo '<div class="col-md-4">   <div class="card m-5" style="width: 18rem;">
<div class="card-body">
  <h5 class="card-title">'.$row['worker_name'].'</h5>
  <h6  style="color:#D7BE69" class="card-subtitle mb-2 ">'.$star.' </h6>
  <h6 class="card-subtitle mb-2 text-muted">'.$row['worker_exp'].' years experience</h6>
  <p class="card-text">'.$row['worker_expertise'].'</p>
  <img src="icon.png" width="30px" height="30px"/><a href="tel:'.$row['phone'].'" class="card-link"> '.$row['phone'].'</a>
<br>';
if(!isset($_SESSION['worker']))
{ 
echo '<small><form action="rate.php" method="post">
<input name="id" value='.$row['worker_id'].' style="display:none">
<input type="submit" name="submit" value="Rate this worker" class="btn-primary btn my-2">
</form>
<form action="request.php" method="post">
<input name="w_id" value='.$row['worker_id'].' style="display:none">
<input name="w_cat" value='.$row['worker_cat'].' style="display:none">
<input type="submit" name="submit1" value="Request service" class="btn-primary btn my-2">
</form></small>';
}

echo '  
</div></div>
</div>';
}
echo "</div>";
}

        ?>
    </div>
</body>
</html>