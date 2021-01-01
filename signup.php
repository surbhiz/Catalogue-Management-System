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

if(isset($_POST['signup'])){
//Get form data

  $fullname=$_POST['fullname'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $passrepeat=$_POST['passrepeat'];
  $role=$_POST['role'];

  if(empty($fullname)){
    $error="Full Name required";
  }
  if(empty($email)){
    echo '<script type="text/javascript">alert("Email required") </script>';
    $error="Email required";
  }
  if(empty($password)){
    echo '<script type="text/javascript">alert("Password required") </script>';
    $error="Password required";
  }
  if(!preg_match('/^[0-9A-Za-z!@#$%]{8,10}$/', $password)) {
    echo '<script type="text/javascript">alert("Password does not meet the requirement") </script>';
}
  if (strlen($fullname)< 5) {
    echo '<script type="text/javascript">alert("Please enter your Full Name") </script>';
    $error="<p>Please enter your Full Name</p>";
  }
  if(!preg_match("/^[a-zA-Z ]*$/",$fullname)){
    echo '<script type="text/javascript">alert("Only letters and white spaces are allowed") </script>';
    $error="<p>Only letters and white spaces are allowed</p>";
  }
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo '<script type="text/javascript">alert("Email address is invalid") </script>';
    $error="Email address is Invalid";
  }
  if($passrepeat !== $password){
    echo '<script type="text/javascript">alert("Your passwords do not match!!") </script>';
    $error="<p>Your passwords do not match!!</p>";
  }
    $emailQuery="SELECT role FROM students WHERE email=? LIMIT 1";
    $stmt=$conn->prepare($emailQuery);
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result=$stmt->get_result();
    $userCount=$result->num_rows;

  if($userCount>0){
    echo '<script type="text/javascript">alert("Email address already exists") </script>';
    $error="Email address already exists";

}

  $emailQuery1="SELECT role FROM staff WHERE email=? LIMIT 1";
  $stmt1=$conn->prepare($emailQuery1);
  $stmt1->bind_param('s',$email);
  $stmt1->execute();
  $result1=$stmt1->get_result();
  $userCount1=$result1->num_rows;
  if($userCount1>0){
    echo '<script type="text/javascript">alert("Email address already exists") </script>';
    $error="Email address already exists";
  }

  $emailQuery2="SELECT role FROM admin_table WHERE email=? LIMIT 1";
  $stmt2=$conn->prepare($emailQuery2);
  $stmt2->bind_param('s',$email);
  $stmt2->execute();
  $result2=$stmt2->get_result();
  $userCount2=$result2->num_rows;
  if($userCount2>0){
    echo '<script type="text/javascript">alert("Email address already exists") </script>';
    $error="Email address already exists";
  
}

  else{
    //Form is valid
    //Connect to Database
    $token= md5(time().$fullname);

    $password=md5($password);
    $passrepeat=md5($passrepeat);

    if($role == 'Student'){
      $query= "INSERT INTO students(fullname,email, password, passrepeat, role, token) VALUES (?,?,?,?,?,?)";
      $stmt=$conn->prepare($query);
      $stmt->bind_param('ssssss',$fullname, $email, $password,$passrepeat, $role, $token);
      $stmt->execute();
      if($stmt){
        echo '<script type="text/javascript">alert("Email Verification code is sent on your email address!") </script>';
        $to = $email;
        $subject= "Email Verification";
        $message=" Welcome $fullname ! <br />
        Thanks for signing up! <br />
        Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below. <br />
        Please click this link to activate your account:http://localhost/SignIn/verification.php?token=$token <br />
        Email Address : $email <br />
        Role : $role ";
        $headers = "From: surbhiszambad@gmail.com \r\n";
        $headers .= "MIME-Version:1.0". "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8". "\r\n";
        mail($to,$subject,$message,$headers);
        header('location:thankyou.php'); 
      }
    }

    if($role == 'Staff'){
      $query= "INSERT INTO staff(fullname,email, password, passrepeat, role, token) VALUES (?,?,?,?,?,?)";
      $stmt=$conn->prepare($query);
      $stmt->bind_param('ssssss',$fullname, $email, $password,$passrepeat, $role, $token);
      $stmt->execute();
      if($stmt){
        echo '<script type="text/javascript">alert("Email Verification code is sent on your email address!") </script>';
        $to = $email;
        $subject= "Email Verification";
        $message=" Welcome $fullname \n
        Thanks for signing up!\n
        Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
        Please click this link to activate your account:http://localhost/SignIn/verification.php?token=$token";
        $headers = "From: surbhiszambad@gmail.com \r\n";
        $headers .= "MIME-Version:1.0". "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8". "\r\n";
        mail($to,$subject,$message,$headers);
        header('location:thankyou.php'); 
      }
    }

    if($role == 'Admin'){
      $query= "INSERT INTO admin_table(fullname,email, password, passrepeat, role, token) VALUES (?,?,?,?,?,?)";
      $stmt=$conn->prepare($query);
      $stmt->bind_param('ssssss',$fullname, $email, $password,$passrepeat, $role, $token);
      $stmt->execute();
      if($stmt){
        echo '<script type="text/javascript">alert("Email Verification code is sent on your email address!") </script>';
        $to = $email;
        $subject= "Email Verification";
        $message=" Welcome $fullname \n
        Thanks for signing up!\n
        Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
        Please click this link to activate your account:http://localhost/SignIn/verification.php?token=$token";
        $headers = "From: surbhiszambad@gmail.com \r\n";
        $headers .= "MIME-Version:1.0". "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8". "\r\n";
        mail($to,$subject,$message,$headers);
        header('location:thankyou.php'); 
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
  <title>Sign Up</title>
  <script>
function validateForm() {
  var fullname = document.forms["myForm"]["fullname"].value;
  var email = document.forms["myForm"]["email"].value;
  var password = document.forms["myForm"]["password"].value;
  var passrepeat = document.forms["myForm"]["passrepeat"].value;
  if (fullname == "") {
    alert("Full Name required");
    return false;
  }
  if (email == "") {
    alert("Email required");
    return false;
  }
  if (password == "") {
    alert("Password required");
    return false;
  }
  if (passrepeat == "") {
    alert("Password required");
    return false;
  }
  if(password != passrepeat){
    alert("Your passwords do not match");
    return false;
  }

}

  </script>
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
    <div class="col-12 col-s-3">
    <center><p id="error"></p></center>
  <div class="main1">

    <p class="sign" align="center">Sign Up</p>
    <form class="form1" action="signup.php" method="POST" name="myForm" onsubmit="return validateForm()">
        <label for="fullname">FULL NAME</label>
        <input class="fullname" type="text" id="fullname" autocapitalize="off" autocorrect="off"  align="center" placeholder="Full name" name="fullname"/>
        <label for="email">EMAIL</label>
      <input class="un" name="email" type="email" id="email" autocapitalize="off" autocorrect="off"  align="center" placeholder="Email"/>
      <label for="password">PASSWORD</label>
      <input class="pass" name="password" id="password" type="password" placeholder="Password" pattern="(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*].{8,10}"/>
      <label for="passrepeat">CONFIRM PASSWORD</label>
      <input class="pass-repeat" id="passrepeat" name="passrepeat" type="password" placeholder="Password" pattern="(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*].{8,10}"/>
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
      <input class="register" align="center" type="submit" name="signup" value="Register"></input>
    </div>
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