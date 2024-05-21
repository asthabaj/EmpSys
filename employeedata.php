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
  
  

  $sql1 ="select * from employee where deleted_at IS NULL";
  //where user_id = '$userid'";
  $result1 = mysqli_query($con, $sql1);
  if($result1) {
      $employee = mysqli_fetch_assoc($result1);
      //echo var_dump($employee);
  } else {
      echo "Error: " . mysqli_error($con);
  }
  
  

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Employee List</title>
  </head>
  <body>
  <?Php
    include "partial/header.php";
    ?>

  
<div class="modal fade" id="employeemodal" tabindex="-1" role="dialog" aria-labelledby="employeemodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="employeemodalLabel">Add employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <form action="addemployee.php" method="POST">
        <div class="form-group">
          <label for="">First Name</label>
          <input type="text" class="form-control" name="fname" id="fname" >
        </div>
        <div class="form-group">
          <label for="">Last Name</label>
          <input type="text" class="form-control" name="lname" id="lname" >
        </div>
        <div class="form-group">
          <label for="">Email </label>
          <input type="text" class="form-control" name="email" id="email" >
        </div>
        <div class="form-group">
          <label for="">Phone </label>
          <input type="number" class="form-control" name="phone" id="phone" >
        </div>
        <div class="form-group">
          <label for="">Address </label>
          <input type="text" class="form-control" name="address" id="address" >
        </div>
        <div class="form-group">
            <label for="dept_name">Department</label>
            <select name="dept_name" id="dept_name" class="form-control" required>
                <option value="">Select Department</option>
                <?php 
                // Move the code to fetch options here
                $sql2 ="select * from department";
                $result2 = mysqli_query($con, $sql2);
                if($result2) {
                    while($row = mysqli_fetch_assoc($result2)) {
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['dept_name']; ?></option>
                        <?php 
                    }
                } else {
                    echo "Error: " . mysqli_error($con);
                }
                ?>
            </select>
        </div>
        <!-- Hidden input field for dept_id -->
        <input type="hidden" name="dept_id" id="dept_id">
        <!-- Submit button -->
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="save" class="btn btn-primary">Save</button>
      </div>
    </form>
</div>

<script>
    document.getElementById('dept_name').addEventListener('change', function() {
        var selectedDeptId = this.value;
        document.getElementById('dept_id').value = selectedDeptId;
    });
</script>
        </div>
        
    </div>
  </div>
</div>

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
                    <h1 >Employee List
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#employeemodal">
                        Add New Employee
                        </button>
                    </h1>
                    </div>
                    <div class="card-body">
                    
                    <table class="table table-bordered">
  <thead>
    <tr>
    <th scope="col">ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM employee where deleted_at IS NULL";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_array($result))
        //foreach ($result as $row) also okay
        {
            ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo $row['fname']?></td>
                <td><?php echo $row['lname']?></td>
                <td>
                    <a href="view.php?id=<?php echo $row['id']; ?>" class="badge badge-primary">VIEW</a>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="badge badge-info">EDIT</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="badge badge-danger">DELETE</a>
                </td>
      
    </tr>
<?php
        }
    }
    else
    {
        echo "no data";
    }
    ?>
    
  </tbody>
</table>
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