<?php
$dbserver = 'localhost';
$username = 'root';
$password = '';
$dbdatabase = 'cataloguesystem';

try {
    $conn = mysqli_connect($dbserver,$username,$password,$dbdatabase);

} catch (Exception $e) {
    echo "Connection failed".$e->getMessage();
}

	if( isset($_POST['login']) ) {
		$conn = mysqli_connect($dbserver,$username,$password,$dbdatabase);
    $email=$_POST['email'];
    $password=$_POST['password'];
    $role=$_POST['role'];
    $password=md5($password);
    if(empty($email)){
      $error="Email required";
    }
    if(empty($email)){
      echo '<script type="text/javascript">alert("Email required") </script>';
      $error="Password required";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      echo '<script type="text/javascript">alert("Email address is invalid") </script>';
      $error="Email address is Invalid";
    }
    if(empty($password)){
      echo '<script type="text/javascript">alert("Password required") </script>';
      $error="Password required";
    }

    $emailQuery="SELECT * FROM students WHERE email='$email' AND password='$password' AND role='$role' AND confirmation='1' ";
    $result= mysqli_query($conn, $emailQuery);
    $verify = mysqli_num_rows($result);
    if($verify==1){
      header('location: students_homepage.php');
    }
    else{
      $emailQuery="SELECT * FROM staff WHERE email='$email' AND role='$role' AND confirmation='1' ";
      $result= mysqli_query($conn, $emailQuery);
      $verify = mysqli_num_rows($result);
      if($verify==1){
        
        header('location: staff_homepage.php');
      }
      else{
        $emailQuery="SELECT * FROM admin_table WHERE email='$email' AND role='$role' AND confirmation='1' ";
        $result= mysqli_query($conn, $emailQuery);
        $verify = mysqli_num_rows($result);
        if($verify==1){
          
          header('location: admin_homepage.php');
      }
      }
    }





	}
?>



<html>

<head>
  <link rel="stylesheet" href="cataloguesystem.css">
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sign in</title>
</head>

<body>
  <div id="wrapper">
    <header>
      <a class="new_page login" href="login.php"
        ><span class="fa fa-sign-in"></span> Login</a
      >
      <a class="new_page sign_up" href="signup.php"
        ><span class="fa fa-edit"></span> Sign Up</a
      >
      <a class="social youtube" href="https://www.youtube.com/" target="_blank"
        ><i class="fa fa-youtube-play"></i
      ></a>
      <a class="social instagram" href="https://www.instagram.com/" target="_blank"
        ><i class="fa fa-instagram"></i
      ></a>
      <a class="social facebook" href="http://www.facebook.com/" target="_blank">
        <i class="fa fa-facebook"></i>
      </a>
    </header>

    <div class="welcome">
      <h1>Catalogue Management System</h1>
      <p>We got courses for every taste!</p>
      <ul>
        <li><a href="#">Forum</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="index.html">Home</a></li>
      </ul>
    </div>
    
  <div class="main" style="height:450px">
    <p class="sign" align="center">Sign in</p>
    <form name="loginForm" class="form1" action="login.php" method="POST">
        <label for="email">EMAIL</label>
      <input class="un " name="email" type="email" autocapitalize="off" align="center" placeholder="Email" required/>
      <label for="email">PASSWORD</label>
      <input class="pass" name="password" type="password" placeholder="Password" required/>
      <div class="row">
        <div class="col-12">
      <div class="col25">
      <label for="radio">ROLE</label></div>
      <div class="col75">
        <input name="role" type="radio" value="Student" checked="checked">
       Student
       <input name="role" type="radio" value="Staff">
       Staff
       <input name="role" type="radio" value="Admin">
       Admin
    </div>
  </div>
</div>
      <p class="forgot" align="center"><a href="forgotpassword.php">Forgot Password?</p>
      <input type="submit" class="submit" align="center" value="Sign in" name="login">

    </div>
    
    <div class="clear"></div>
    <div class="footer">
      <strong>&copy; Copyright 2020, Created by: Surbhi Zambad</strong><br>
      <strong>&reg; All rights reserved</strong>
   
   <strong  style="float: right; padding-right: 10px;" >Contact <i class="fa fa-phone"></i> : 6025876818</strong>
      </div>
      </div>
</body>

</html>