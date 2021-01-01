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
if(!isset($_GET["token"])){
  exit("Can't find page");
}


if (isset($_GET['token'])) {
  $token = $_GET['token'];
  $sql = $conn->query("SELECT token FROM students WHERE confirmation='0'");


  if ($sql->num_rows > 0) {
    $conn->query("UPDATE students SET confirmation=1 WHERE token='$token'");
    echo '<center><h1>Email address verified. You can <a href="http://localhost/SignIn/login.php">login</a> now.</h1></center>';
    }

  $sql1 = $conn->query("SELECT token FROM staff WHERE confirmation='0'");
  if ($sql1->num_rows > 0) {
    $conn->query("UPDATE staff SET confirmation=1 WHERE token='$token'");
    echo '<center><h1>Email address verified. You can <a href="http://localhost/SignIn/login.php">login</a> now.</h1></center>';
  }

  $sql2 = $conn->query("SELECT token FROM admin_table WHERE confirmation='0'");
  if ($sql2->num_rows > 0) {
    $conn->query("UPDATE admin_table SET confirmation=1 WHERE token='$token'");
    echo '<center><h1>Email address verified. You can <a href="http://localhost/SignIn/login.php">login</a> now.</h1></center>';
      }


}



?>

<!DOCTYPE html>
<html>
  <head>
    <title>Verfication</title>
  </head>
  <body>
      <center>
    <img
      src="images/Horray.PNG"
      style="width: 400px; height: 400px; text-align: center"
    /></center>
  </body>
</html>