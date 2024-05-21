<?php
session_start();
include "functions.php";
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit;
}
if(isset($_SESSION['userid'])){
$userid = $_SESSION['userid'];
$sql = "SELECT * FROM user WHERE id = '$userid'";
$result = mysqli_query($con, $sql);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . mysqli_error($con);
    exit;
}
}

if (isset($_GET['id'])) {
    $empid = $_GET['id'];
    $sql1 = "SELECT * FROM employee WHERE id = '$empid'";
    $result1 = mysqli_query($con, $sql1);
    if ($result1 && mysqli_num_rows($result1) > 0) {
        $employee = mysqli_fetch_assoc($result1);
    } else {
        echo "Employee not found.";
        exit;
    }
} else {
    echo "Invalid employee ID.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $empid = $_POST['empid'];
    $sql = "UPDATE `employee` SET `deleted_at` = NOW() WHERE id = '$empid'";
    $sql2 = "UPDATE `user` SET `deleted_at` = NOW() WHERE id = '$userid'";
    
    if (mysqli_query($con, $sql) && mysqli_query($con, $sql2)) {
        $_SESSION['status'] = "Employee deleted successfully.";
    } else {
        $_SESSION['status'] = "Error deleting employee.";
    }
    header('Location: employeedata.php');
    exit;
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
    <title>Delete Employee</title>
</head>
<body>
    <!-- Employee Modal -->
    <div class="modal" tabindex="-1" role="dialog" style="display: block;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <?php echo htmlspecialchars($employee['fname']) . " " . htmlspecialchars($employee['lname']); ?>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href='employeedata.php'">Close</button>
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="empid" value="<?php echo htmlspecialchars($employee['id']); ?>">
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
