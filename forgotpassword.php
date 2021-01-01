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
if(isset($_POST["cont"])){
    $conn = mysqli_connect($dbserver,$username,$password,$dbdatabase);
    $email=$_POST['email'];
    $token= md5(time().$email);
    $query= "INSERT INTO resetpassword(token, email) VALUES (?, ?)";
    $stmt=$conn->prepare($query);
    $stmt->bind_param('ss',$token, $email);
    $stmt->execute();
    if ($stmt){
    echo '<script type="text/javascript">alert("Reset password link is sent on your email address!") </script>';
    $to = $email;
    $subject= "Reset Email";
    $message=" Welcome! <br/>
    Please click this link to change the password for your account:http://localhost/SignIn/resetpassword.php?token=$token";
    $headers = "From: surbhiszambad@gmail.com \r\n";
    $headers .= "MIME-Version:1.0". "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8". "\r\n";
    mail($to,$subject,$message,$headers);
    header('Refresh:5','url: forgotpassword.php');
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
  <title>Forgot password</title>
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
    <p class="sign" align="center">Forgotten your password?</p>
    <p>Don't worry, we'll send you a message to help you reset your password.</p>
    <form name="loginForm" class="form1" method="POST" action="forgotpassword.php">
        <label for="email" style="margin-top:30px; margin-bottom:10px ; margin-right:35px">EMAIL</label>
      <input class="un" style="margin-right:35px" name="email" type="email" autocapitalize="off" autocorrect="off"  align="center" placeholder="Email address" required/>
      <input type="submit" align="center" value="Continue" name="cont" style="cursor: pointer;
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