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
  $fullname=$_POST['fullname'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $passrepeat=$_POST['passrepeat'];
  $role=$_POST['role'];

  if(empty($fullname)){
    echo '<script type="text/javascript">alert("Full Name required") </script>';
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

  $emailQuery="SELECT * FROM students WHERE email=? LIMIT 1";
  $stmt=$conn->prepare($emailQuery);
  $stmt->bind_param('s',$email);
  $stmt->execute();
  $result=$stmt->get_result();
  $userCount=$result->num_rows;
  
  if($userCount>0){
    echo '<script type="text/javascript">alert("Email address already exists") </script>';
    $error="Email address already exists";
  }
  else{


    $token= md5(time().$fullname);
    $password=md5($password);
    $passrepeat=md5($passrepeat);

    if($role=="Student")
    $addquery="INSERT INTO students(fullname,email, password, passrepeat, role, token) VALUES ('$fullname','$email','$password','$passrepeat','$role','$token')";
    $query= mysqli_query($conn, $addquery);

    if($query== TRUE){
    echo '<script type="text/javascript">alert("Record has been added successfully") </script>';

      $to = $email;
      $subject= "Email Verification";
      $message=" Welcome $fullname !  <br />
      Thanks for signing up! <br />
      Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
      <br />
      Please click this link to activate your account:http://localhost/SignIn/verification.php?token=$token  <br />
      Email Address : $email <br />
      Password : .$password "
      ;
      $headers = "From: surbhiszambad@gmail.com \r\n";
      $headers .= "MIME-Version:1.0". "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8". "\r\n";
      mail($to,$subject,$message,$headers);
      header('Refresh:5','url: users.php');
    }

    elseif($role=="Staff"){
    $addquery="INSERT INTO staff(fullname,email, password, passrepeat, role, token) VALUES ('$fullname','$email','$password','$passrepeat','$role','$token')";
    $query= mysqli_query($conn, $addquery);

    if($query== TRUE){
    echo '<script type="text/javascript">alert("Record has been added successfully") </script>';

      $to = $email;
      $subject= "Email Verification";
      $message=" Welcome $fullname !  <br />
      Thanks for signing up! <br />
      Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
      <br />
      Please click this link to activate your account:http://localhost/SignIn/verification.php?token=$token  <br />
      Email Address : $email <br />
      Role : $role "
      ;
      $headers = "From: surbhiszambad@gmail.com \r\n";
      $headers .= "MIME-Version:1.0". "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8". "\r\n";
      mail($to,$subject,$message,$headers);
      header('url: users.php');
  }}
  else {
    echo '<script type="text/javascript">alert("Record has not been added successfully. Please try again.") </script>';
    header('url: users.php');
  }
}
}


if(isset($_POST['update'])){
  $id=$_POST['id'];
  $fullname=$_POST['fullname'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $passrepeat=$_POST['passrepeat'];
  $role=$_POST['role'];



  $password=md5($password);
  $passrepeat=md5($passrepeat);

  if($role=="Student"){
  $query= "UPDATE students SET fullname='$fullname', email='$email', password='$password', passrepeat='$passrepeat', role='$role' WHERE id='$id'";
  $stmt=mysqli_query($conn,$query);

    if($stmt== TRUE){
      echo '<script type="text/javascript">alert("Record has been updated") </script>';
      header('url: users.php');
    }}

  elseif($role=="Staff"){
    $query= "UPDATE staff SET fullname='$fullname', email='$email', password='$password', passrepeat='$passrepeat', role='$role' WHERE id='$id'";
    $stmt=mysqli_query($conn,$query);

    if($query== TRUE){
      echo '<script type="text/javascript">alert("Record has been updated") </script>';
      header('url: users.php');
  }}
  else {
    echo '<script type="text/javascript">alert("Record has not been updated successfully. Please try again.") </script>';
    header('url: users.php');
  }
}


$result= mysqli_query($conn,"SELECT * FROM students");
$result1 = mysqli_query($conn,"SELECT * FROM staff");

?>



<html>
  <head>
    <link rel="stylesheet" href="cataloguesystem.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Users</title>
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
          <li><a class="active" href="#">Users</a></li>
          <li><a href="http://ssz3409.uta.cloud/Phase2/blog/" target="_blank">Forum</a></li>
          <li><a href="aboutadmin.html">About</a></li>
          <li><a href="admin_homepage.php">Home</a></li>
        </ul>
      </div>
      <center><h2 style="color: #271065">Users</h2></center>
     <table>
       <tr>
       <th> ID</th>
    <th> Full Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Delete</th>
  </tr>
  <?php
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
        <tr>
        <td><?php  echo $row['id'];?></td>
          <td><?php  echo $row['fullname'];?></td>
       <td><?php  echo $row['email'];?></td>
        <td><?php  echo $row['role'];?></td>
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
  box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);" href="delete.php?Del=<?php echo $row['fullname'] ?>" >Delete</a></td>
      </tr>
<?php
      }
      ?>

<?php
      while($row1 = mysqli_fetch_assoc($result1))
      {
      ?>
        <tr>
        <td><?php  echo $row1['id'];?></td>
          <td><?php  echo $row1['fullname'];?></td>
       <td><?php  echo $row1['email'];?></td>
        <td><?php  echo $row1['role'];?></td>
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
  box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);" href="delete.php?Del=<?php echo $row1['fullname'] ?>"  >Delete</a></td>
      </tr>
<?php
      }
      ?>
    
  </tr>
  
     </table>
  <form action="users.php" method="POST">
    <fieldset style="padding:20px">
    <label for="id">ID</label>
      <input class="fullname" type="number"  name="id" autocapitalize="off" autocorrect="off"  align="center" placeholder="ID" required/>
     <label for="email">FULL NAME</label>
      <input class="fullname " name="fullname" type="text" autocapitalize="off" autocorrect="off"  align="center" placeholder="Full Name" required/>
      <label for="email">EMAIL</label>
      <input class="un" name="email" type="email" placeholder="Email" required/>
      <label for="email">PASSWORD</label>
      <input class="pass" name="password" type="password" placeholder="Password" required/>
      <label for="email">CONFIRM PASSWORD</label>
      <input class="pass" name="passrepeat" type="password" placeholder="Confirm Password" required/>
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
      <input type="submit" align="center" value="Add Record" name="add" style="  cursor: pointer;
  color: #fff;
  background: #0156b7;
  border: 0;
  padding-left: 40px;
  padding-right: 40px;
  padding-bottom: 10px;
  padding-top: 10px;
  margin-left: 4%;
  font-size: 13px;
  box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);">
    <input type="submit" align="center" value="Update Record" name="update" style="  cursor: pointer;
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
