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
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <?Php
    include "partial/header.php";
    ?>
  <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <?php
                  if (isset($_SESSION['status'])&& $_SESSION['status']!='')
                  {
                    echo $_SESSION['status'];
                    unset($_SESSION['status']);
                  }
                  ?>
                    <div class="card-header">
                    <h1 >Dashboard
                        
                    </h1>
                    </div>
                    <div class="card-body">
                    
                    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <div class="row">
    
        
        <div class="col-md-4 col-xl-3">
            
                <div style="background-color:#ced4da ; padding:10px; border-radius:10px;" class="card-block">
                    <h1 class="m-b-20">Employee Count</h1>
                    <h2 class="text-right"><span>
                        <?php
                        $sql1 = "SELECT * FROM employee where deleted_at is Null";
                        $result1 = mysqli_query($con, $sql1);
                        if ($result1) {
                            $employee = mysqli_fetch_assoc($result1);
                            //echo var_dump($employee);
                        } else {
                            echo "Error: " . mysqli_error($con);
                        }
                        echo "(". mysqli_num_rows($result1). ")";
                        ?>
                    </span></h2>
                </div>
            
        </div>
	</div>
</div>
                   
                </div>
            </div>
        </div>
    </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    

  </body>
</html>