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


if (!isset($_GET['token'])) {
  echo "Page not found";
    }

$token = $_GET['token'];
$sql = mysqli_query($conn,"SELECT email FROM resetpassword WHERE token='$token'");

if (isset($_POST['updatepass'])){
  $password = $_POST["password"];
  $passrepeat=$_POST['passrepeat'];
  $password = md5($password);
  $passrepeat=md5($passrepeat);

  $row= mysqli_fetch_array($sql);
  $email = $row["email"];
  $query=mysqli_query($conn,"UPDATE students SET password='.$password', passrepeat='.$passrepeat' WHERE email='$email'");
  $query=mysqli_query($conn,"UPDATE staff SET password='$password' , passrepeat='.$passrepeat' WHERE email='$email'");

  if($query){
    $query=mysqli_query($conn,"DELETE FROM resetpassword WHERE token='$token'");
    echo '<script type="text/javascript">alert("Password updated") </script>';
    }
  else{
    echo "Something went wrong";
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
  <title>Reset password</title>
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
<center>
    <div class="main" style="margin:15%">
    <p class="sign" align="center">Reset Password</p>
    <p>You can reset your password here.</p>
    <form name="loginForm" class="form1" method="POST">
        <label for="email" style="margin-top:30px; margin-bottom:10px ; margin-right:35px">New Password</label>
      <input class="pass" style="margin-right:35px" name="password" type="password" autocapitalize="off" autocorrect="off"  align="center" placeholder="New Password" pattern="(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*].{8,10}" required/>
      <label for="email" style="margin-top:30px; margin-bottom:10px ; margin-right:35px">Confirm New Password</label>
      <input class="pass" style="margin-right:35px" name="passrepeat" type="password" autocapitalize="off" autocorrect="off"  align="center" placeholder="Confirm New Password" pattern="(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*].{8,10}" required/>
      <input type="submit" align="center" value="Update Password" name="updatepass" style="cursor: pointer;
  color: #fff;
  background: #0156b7;
  border: 0;
  padding-left: 60px;
  padding-right: 60px;
  padding-bottom: 10px;
  padding-top: 10px;
  font-size: 13px;
  box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);">

    </div></center>
    <div class="clear"></div>
    <div class="footer">
      <strong>&copy; Copyright 2020, Created by: Surbhi Zambad</strong><br>
      <strong>&reg; All rights reserved</strong>
   
   <strong  style="float: right; padding-right: 10px;" >Contact <i class="fa fa-phone"></i> : 6025876818</strong>
      </div>
</div>
</body>

</html>
