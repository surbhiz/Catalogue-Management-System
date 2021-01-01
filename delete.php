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

if(isset($_GET['Del'])){
    $fullname = $_GET['Del'];
    $query ="DELETE FROM students WHERE fullname='$fullname'";
    $result=mysqli_query($conn,$query);
    if($result){
        echo '<script type="text/javascript">alert("Record has been updated deleted.") </script>';
        header("location:users.php");
    }

    $query ="DELETE FROM staff WHERE fullname='$fullname'";
    $result=mysqli_query($conn,$query);
    if($result){
        echo '<script type="text/javascript">alert("Record has been updated deleted.") </script>';
        header("location:users.php");
    }

else{
    echo '<script type="text/javascript">alert("Please check your connection") </script>';

    }


}

if(isset($_GET['Delet'])){
    $course_id = $_GET['Delet'];
    $query ="DELETE FROM courseslist WHERE course_id='$course_id'";
    $result=mysqli_query($conn,$query);
    if($result){
        echo '<script type="text/javascript">alert("Record has been updated deleted.") </script>';
        header("location:upcoming.php");
    }
else{
    echo '<script type="text/javascript">alert("Please check your connection") </script>';

    }


}
?>