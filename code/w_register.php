<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
		body{
			background-image: url('back2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
		}

	</style>
</head>
<body>
   
    <h1 class='my-3' align='center'>Worker Registration</h1>
<form class='container my-4 w-50' id='myform' action='' method='post'>
  <div class="form-group">
  <div class="form-group">
    <label for="exampleInputPassword1">Name</label>
    <input type="text" class="form-control" name='name'required placeholder="Enter your Name">
  </div>

    <label for="exampleInputEmail1">Email address</label>
    <input type="email" required class="form-control" name='email' id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" required class="form-control" name='password'  id='pass' placeholder="Password">
  </div>
 
  
  <input name='submit' type='submit' value='submit'  class="btn btn-primary">
  <br><small><a href="register.php">are you a customer?register here</a><br><a href="worker_login.php">already have an account?</a></small>
</form>
  
</body>
<?php
if(isset($_POST['submit'])){

require('../db_connect/database.php');
$uname=$_POST['name'];
$email=$_POST['email'];
$psw=md5($_POST['password']);
if($conn->connect_error)
	  {
  		die("Connection failed:" .$conn->connect_error);
	  }
	else
	  {
		$sql1="SELECT * FROM `registration` where `email`='$email'";
		$result = $conn->query($sql1);
		 if($result->num_rows>0)//when db records are found store in associative array...
        {
		 
	  echo"<script language='javascript'>
	
	  alert('user already exists');
	  location.href='w_register.php';
</script>";
	  }else{
        $sql2 ="INSERT INTO `registration`( `uname`,  `email`, `psw`) VALUES ('$uname','$email','$psw')";
        if($conn->query($sql2)===TRUE)
		 {
      session_start();
      $_SESSION['email']=$email;
      echo"<script language='javascript'>
      location.href='w_details.php';
  </script>";
     }}}}
?>

    

</html>