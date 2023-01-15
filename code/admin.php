<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
       .painter{
            width:100% !important;
			background-image: url('back4.jpg') !important;
            background-repeat: no-repeat;
            background-size: cover !important;
	        background-position:        0px;
            
        } 
        body{
            overflow-x:hidden;
        }
    </style>
    <link rel="stylesheet" href="styl.css">
    <link rel="stylesheet" href="painter.css">
  

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Painters</title>
</head>
<body>     <nav>
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
                 
                 <li><a href="login.php">Logout</a></li>
             
               </ul>
      </nav>
    <div class='painter'>
        
   <h1 align='center'  class='py-3 head' >
   ADMIN PANEL
</h1>
    </div>
    <div class='table my-5'>
        
   

        <?php


session_start();
$_SESSION['user'] = 'admin'; 
$_SESSION['cust_id']='admin';
        require('../db_connect/database.php');
        

         //total customers
    $sql1="SELECT * FROM `customer`";
    $result = $conn->query($sql1);
     if($result->num_rows>0)//when db records are found store in associative array...
    {
      // output data of each row
$total=0;
echo '<div class="row"> ';
  while($row = $result->fetch_assoc())
   {
    $total=$total+1;
   }
   echo '  <div class="card mx-5" style="width: 18rem;">
   <div class="card-body">
   <h5 align="center" class="card-title">TOTAL CUSTOMERS</h5>
     <h5 align="center" class="card-title">'.$total.'</h5>
   

   </div>
 </div>';

}


   //total workers
   $sql1="SELECT * FROM `worker`";
   $result = $conn->query($sql1);
    if($result->num_rows>0)//when db records are found store in associative array...
   {
     // output data of each row
$total=0;

 while($row = $result->fetch_assoc())
  {
   $total=$total+1;
  }
  echo '  <div class="card mx-5" style="width: 18rem;">
  <div class="card-body">
  <h5 align="center" class="card-title">TOTAL WORKERS</h5>
    <h5 align="center" class="card-title">'.$total.'</h5>
  

  </div>
</div>';
echo '</div> ';
}
echo "<h2 align='center'  class='my-5'  ><b>WORKERS DETAILS</b></h2>";
//all workers

$sql1="SELECT * FROM `worker` ";
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
<form name="deleteu" action="delete.php" method="post">
<input name="w_id" value='.$row['worker_id'].' style="display:none">

<input type="button" onclick="cdelete()" name="submit1" value="DELETE WORKER" class="btn-danger btn my-2">
</form></small>';
}

echo '  
</div></div>
</div>';
}
echo "</div>";
}

   
        ?>
        <script>
            function cdelete(){
               var c=confirm('do you really want to delete this worker from your website')
               if(c==true){
                document.forms["deleteu"].submit();
                               }else{

               }
            }
        </script>
    </div>
</body>
</html>