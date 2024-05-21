<?php
session_start();
include "functions.php";

if(isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];

    $sql = "SELECT * FROM user WHERE id = '$userid'";
    $result = mysqli_query($con, $sql);

    if($result) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    
    echo "Error: userid not set in session";
    header("location:login.php");
}



if(isset($_POST['save']))
{
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $address=$_POST['address'];
  $dept=$_POST['dept_id'];

  $sql = "INSERT INTO employee (`fname`, `lname`, `email`, `phone`, `address`, `dept_id`) VALUES ('$fname','$lname','$email',' $phone',' $address',' $dept')";
  $result=mysqli_query($con,$sql);

  echo "mysqli_fetch_array($result)";

  if($result)
  {
    $_SESSION['status'] = 'Added Successfully';
    header("location:employeedata.php");
  }
  else
  {
    $_SESSION['status'] = 'Not Added ';
    header("location:employeedata.php");
  }
}
?>
