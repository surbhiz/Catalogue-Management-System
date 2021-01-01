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
$result= mysqli_query($conn,"SELECT * FROM viewcourses WHERE Course_Name='Computer Science and Engineering';");
$result1= mysqli_query($conn,"SELECT * FROM viewcourses WHERE Course_Name='Electrical Engineering';");
$result2= mysqli_query($conn,"SELECT * FROM viewcourses WHERE Course_Name='Civil Engineering';");
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
          <li><a href="feedback.php">Feedback</a></li>
          <li><a class="active" href="#">List of Courses</a></li>
          <li><a href="http://ssz3409.uta.cloud/Phase2/blog/" target="_blank">Forum</a></li>
          <li><a href="aboutstudent.html">About</a></li>
          <li><a href="students_homepage.php">Home</a></li>
        </ul>
      </div>
      <center><h2 style="color: #271065">Courses offered</h2></center>

      <h3
        id="computerscience"
        style="
          margin-left: 50px;
          background-color: #bbdefb;
          padding: 5px;
          display: inline-block;
        "
      >
        Computer Science and Engineering Courses
      </h3>
      <div class="Rtable Rtable--4cols">
      <?php
      while(($row = mysqli_fetch_array($result)) && ($row['Course_Name']=='Computer Science and Engineering'))
      {
      ?>
        <div class="Rtable-cell">
          <h3>
         
              <?php  echo $row['course_number'] ;?> <?php  echo $row['subject_name'] ;?>
              
            

          </h3>
      </div>
      <?php
      }
      ?>
</div>

<h3
        id="electrical"
        style="
          margin-left: 50px;
          background-color: #bbdefb;
          padding: 5px;
          display: inline-block;
        "
      >
        Electrical Engineering Courses
      </h3>
      <div class="Rtable Rtable--4cols">
      <?php
      while(($row = mysqli_fetch_array($result1)) && ($row['Course_Name']=='Electrical Engineering'))
      {
      ?>
        <div class="Rtable-cell">
          <h3>
         
              <?php  echo $row['course_number'] ;?> <?php  echo $row['subject_name'] ;?>
              
            

          </h3>
      </div>
      <?php
      }
      ?>
</div>

<h3
        id="civil"
        style="
          margin-left: 50px;
          background-color: #bbdefb;
          padding: 5px;
          display: inline-block;
        "
      >
        Civil Engineering Courses
      </h3>
      <div class="Rtable Rtable--4cols">
      <?php
      while(($row = mysqli_fetch_array($result2)) && ($row['Course_Name']=='Civil Engineering'))
      {
      ?>
        <div class="Rtable-cell">
          <h3>
         
              <?php  echo $row['course_number'] ;?> <?php  echo $row['subject_name'] ;?>
              
            

          </h3>
      </div>
      <?php
      }
      ?>
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
