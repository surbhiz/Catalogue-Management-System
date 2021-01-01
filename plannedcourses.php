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

$result= mysqli_query($conn,"SELECT * FROM courseslist");
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
    <style>
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  padding: 10px;
  width: 100%;
  margin-bottom:40px;
}

td, th {
  border: 1px solid #bbdefb;
  text-align: center;
  padding: 25px;
}

tr:nth-child(even) {
  background-color: #bbdefb;
}
</style>
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
          <li><a href="viewfeedback.php">View Feedback</a></li>
          <li><a class="active" href="#">View Courses</a></li>
          <li><a href="http://ssz3409.uta.cloud/Phase2/blog/" target="_blank">Forum</a></li>
          <li><a href="upcoming.php">Upcoming Courses</a></li>
          <li><a href="aboutstaff.html">About</a></li>
          <li><a href="staff_homepage.html">Home</a></li>
        </ul>
      </div>
      <center><h2 style="color: #271065">Planned courses</h2></center>
      
 
      <table>
       <tr>
    <th> Course Name</th>
    <th>Course Number</th>

  </tr>
  <?php
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
        <tr>
          <td><?php  echo $row['course_name'];?></td>
       <td><?php  echo $row['course_number'];?></td>

      </tr>
<?php
      }
      ?>
    
  </tr>
  
     </table>
    
  </tr>


      <div class="clear"></div>
      <div class="footer">
        <strong>&copy; Copyright 2020, Created by: Surbhi Zambad</strong><br>
         <strong>&reg; All rights reserved</strong>
      
      <strong  style="float: right; padding-right: 10px;" >Contact <i class="fa fa-phone"></i> : 6025876818</strong>
      </div>
    </div>
  </body>
</html>
