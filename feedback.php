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

if( isset($_POST['sendfeedback']) ) {
    $conn = mysqli_connect($dbserver,$username,$password,$dbdatabase);
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $feedback= $_POST['feedback'];
    $emailQuery="SELECT * FROM students WHERE email='$email' AND role='Student' ";
    $result= mysqli_query($conn, $emailQuery);
    $verify = mysqli_num_rows($result);
    if($verify==1){
      $query= "UPDATE students SET feedback='$feedback' where email='$_POST[email]'";
      $stmt=mysqli_query($conn,$query);
      if($stmt){
        echo '<script type="text/javascript">alert("Feedback is sent successfully") </script>';
  }
    }
    else{
      header('location: feedback.php');
    }



    }
if (isset($_POST['sendemail'])) {
      $fullname=$_POST['fullname'];
      $email=$_POST['email'];
      $feedback=$_POST['feedback'];
  
      $to=$email;
      $subject='Feedback Submission';
      $message="Full Name:".$fullname."\n"."Feedback: ".$feedback."\n";
      $headers="From: ".$email;
  
      if(mail($to,$subject,$message,$headers)){
          echo "<h1>Feedback sent successfully</h1>";
      }
      else{
          echo "something went wrong";
      }
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <title>Home Page</title>
    <link rel="stylesheet" href="cataloguesystem.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div id="wrapper">
      <header>
        <a class="new_page login" href="logout.php"
          ><span class="fa fa-sign-out"></span> Logout</a
        >
        <a class="new_page sign_up" href="signup.php"
          ><span class="fa fa-edit"></span> Sign Up</a
        >
        <a
          class="social youtube"
          href="https://www.youtube.com/"
          target="_blank"
          ><i class="fa fa-youtube-play"></i
        ></a>
        <a
          class="social instagram"
          href="https://www.instagram.com/"
          target="_blank"
          ><i class="fa fa-instagram"></i
        ></a>
        <a
          class="social facebook"
          href="http://www.facebook.com/"
          target="_blank"
        >
          <i class="fa fa-facebook"></i>
        </a>
      </header>

      <div class="welcome">
        <h1>Catalogue Management System</h1>
        <p>We got courses for every taste!</p>
        <ul>
          <li><a class="active" href="#">Feedback</a></li>
          <li><a href="courseslist.php">List of Courses</a></li>
          <li><a href="http://ssz3409.uta.cloud/Phase2/blog/" target="_blank">Forum</a></li>
          <li><a href="aboutstudent.html">About</a></li>
          <li><a href="students_homepage.php">Home</a></li>
        </ul>
      </div>
      <div style="max-width: 400px;">
    </div>
    <center>
    <form action="feedback.php" method="post" name="form">
        <div id="feedback-main">
           
            <div id="feedback-div">
                <p align="center" style="color: #0050b8; font-weight: bold; font-size: 20px;">Send Feedback about courses</p>
              <form action="#" class="form" id="feedback-form1" name="form1">
          
                <p class="name">
                  <input name="fullname" type="name" class="feedback-input" required placeholder="Full Name" id="feedback-name" />
                </p>
          
                <p class="email">
                  <input name="email" type="email" class="feedback-input" id="feedback-email" placeholder="Email" required />
                </p>
          
                <p class="text">
                  <textarea name="feedback" type="comment" class="feedback-input" id="feedback-comment" required placeholder="Feedback..."></textarea>
                </p>
          
                <div class="feedback-submit">
                  <input type="submit" value="SEND" name="sendfeedback" id="feedback-button-blue" />
                  <input type="submit" value="SEND Email" id="feedback-button-blue" name="sendemail"/>
                </div>
</form>
</center>
      <div class="clear"></div>
      <div class="footer">
        <strong>&copy; Copyright 2020, Created by: Surbhi Zambad</strong><br>
        <strong>&reg; All rights reserved</strong>
     
     <strong  style="float: right; padding-right: 10px;" >Contact <i class="fa fa-phone"></i> : 6025876818</strong>
      </div>
    </div>
  </body>
</html>
