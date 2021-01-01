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


if(isset($_POST['add'])){
  $course_id=$_POST['course_id'];
  $course_name=$_POST['course_name'];
  $course_number=$_POST['course_number'];
 
  $addquery="INSERT INTO courseslist(course_id,course_name, course_number) VALUES ('$course_id','$course_name','$course_number')";
  $query= mysqli_query($conn, $addquery);
  if($query== TRUE){
    echo '<script type="text/javascript">alert("Record has been added successfully") </script>';
  }
  }

if(isset($_POST['update'])){
  $course_id=$_POST['course_id'];
  $course_name=$_POST['course_name'];
  $course_number=$_POST['course_number'];
  $query= "UPDATE courseslist SET course_name='$course_name', course_number='$course_number' where course_id='$course_id'";
  $stmt=mysqli_query($conn,$query);
 
  if($stmt== TRUE){
    echo '<script type="text/javascript">alert("Record has been updated") </script>';
    header('Refresh:5','url: upcoming.php');
      }
 
  else {
    echo '<script type="text/javascript">alert("Record has not been updated successfully. Please try again.") </script>';
    header('Refresh:5','url: users.php');
  }
}
$result= mysqli_query($conn,"SELECT * FROM courseslist");


?>



<html>
  <head>
    <link rel="stylesheet" href="cataloguesystem.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Upcoming Courses</title>
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
          <li><a href="plannedcourses.php">View Courses</a></li>
          <li><a href="http://ssz3409.uta.cloud/Phase2/blog/" target="_blank">Forum</a></li>
          <li><a class="active" href="#">Upcoming Courses</a></li>
          <li><a href="aboutstaff.html">About</a></li>
          <li><a href="staff_homepage.php">Home</a></li>
        </ul>
      </div>
      <center>
        <h2 style="color: #271065">Courses for Upcoming Semester</h2>
      </center>
      <table>
       <tr>
    <th> Course ID</th>
    <th>Course Name</th>
    <th>Course Number</th>
    <th>Delete</th>
  </tr>

  <?php
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
        <tr>
 
          <td><?php  echo $row['course_id'];?></td>
       <td><?php  echo $row['course_name'];?></td>
        <td><?php  echo $row['course_number'];?></td>
    <td><a style="  cursor: pointer;
  color: #fff;
  background: #0156b7;
  border: 0;
  padding-left: 40px;
  padding-right: 40px;
  padding-bottom: 10px;
  padding-top: 10px;
  margin-left: 4%;
  font-size: 13px;
  box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);" href="delete.php?Delet=<?php echo $row['course_id'] ?>" >Delete</a></td>
      </tr>
<?php
      }
      ?>
  
     </table>

     <form action="upcoming.php" method="POST">
    <fieldset style="padding:20px">
    <label>COURSE ID</label>
      <input class="un" name="course_id" type="text" placeholder="Course ID" required/>
      <label>COURSE NAME</label>
      <input class="un" name="course_name" type="text" placeholder="Course Name" required/>
      <label>COURSE NUMBER</label>
      <input class="pass" name="course_number" type="text" placeholder="Course Number" required/>
      
      <input type="submit" align="center" value="Add Course" name="add" style="  cursor: pointer;
  color: #fff;
  background: #0156b7;
  border: 0;
  padding-left: 40px;
  padding-right: 40px;
  padding-bottom: 10px;
  padding-top: 10px;
  margin-left: 11%;
  font-size: 13px;
  box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);">
    <input type="submit" align="center" value="Update Course" name="update" style="  cursor: pointer;
  color: #fff;
  background: #0156b7;
  border: 0;
  padding-left: 40px;
  padding-right: 40px;
  padding-bottom: 10px;
  padding-top: 10px;
  margin-left: 2%;
  font-size: 13px;
  box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);">
  </fieldset>
</form>
 
      <div class="clear"></div>
 
      <div class="footer">
        <strong>&copy; Copyright 2020, Created by: Surbhi Zambad</strong><br>
        <strong>&reg; All rights reserved</strong>
     
     <strong  style="float: right; padding-right: 10px;" >Contact <i class="fa fa-phone"></i> : 6025876818</strong>
      </div>
    </div>
  </body>
</html>
