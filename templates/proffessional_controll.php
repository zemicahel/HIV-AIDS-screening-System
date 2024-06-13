<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index");
    exit();
}
require('db.php');

$search_username = "";
$rows = null;
error_reporting(0);
if (isset($_POST['search'])) {
    $search_username = $_POST['search_username'];
    $query = "SELECT * FROM `proffesionals` WHERE username='$search_username'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
}

if (isset($_POST['update'])) {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $search_username = $_POST['search_username'];

    if ($pass1 != "" && $pass2 != "") {
        if ($pass1 == $pass2) {
            $query = "UPDATE `proffesionals` SET `password` = '$pass1' WHERE username = '$search_username'";
            $result = mysqli_query($conn, $query);
            echo "<script>alert('Password Changed Successfully!!');</script>";
        } else {
            echo "<script>alert('Make Sure You Typed Both Passwords The Same!!');</script>";
        }
    } else {
        echo "<script>alert('Make Sure You Fill All The Necessary Inputs!!');</script>";
    }
}

if (isset($_POST['delete'])) {
  $search_username = $_POST['search_username'];
  $query = "DELETE FROM `proffesionals` WHERE username = '$search_username'";
  $result = mysqli_query($conn, $query);
  echo "<script>alert('User Deleted Successfully!!');</script>";

  if ($_SESSION['username'] == $search_username) {
      session_destroy();
  }
   echo "<script>window.location.href='user_controll.php';</script>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ERP</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Inter', sans-serif; 
      margin: 0;
      padding: 20px;
      background-color: #f4f4f4;
    }
    .header {
      min-height: 300px;
      background-image: url('images/background.png'); 
      background-size: cover;
      background-position: center top;
      color: white;
      border-radius: 10px;
    }

    .profile-image {
      position: relative;
      top: -50px;
      margin-bottom: -50px;
    }

    .card-body-user-info {
      background-image: url('images/background.png'); 
      background-size: cover;
      background-position: center;
    }
  </style>

</head>
<body>

  <div class="container-fluid">
    <div class="header d-flex align-items-center justify-content-center">
      <div class="text-center">
        <h1 class="display-4">Hello <?php echo $_SESSION['username']?></h1>
        <p>This is the page. where You can search, update, or delete professional details.</p>
      </div>
    </div>
    
    <div class="row mt-4">
      <div class="col-lg-4">
        <div class="card card-profile shadow">
          <div class="card-body text-center">
            <form method="POST">
              <div class="form-group">
                <label for="search_username">Search Username</label>
                <input type="text" id="search_username" name="search_username" class="form-control" value="<?php echo $search_username; ?>">
              </div>
              <input type="submit" id="search" name="search" class="btn btn-primary" value="Search">
            </form>
          </div>
        </div>
      </div>
      
     
      <div class="col-lg-8" >
        <div class="card shadow bg-secondary"style="height:500px">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">User Information</h3>
              </div>
            </div>
          </div>
          <div class="card-body card-body-user-info">
            <form method="POST">
              <input type="hidden" name="search_username" value="<?php echo $rows['username']; ?>">
              <h6 class="heading-small text-muted mb-4">User information</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="userid" class="form-control-label">User Id</label>
                      <input type="text" id="userid" name="userid" class="form-control" value="<?php echo $rows['username'];?>" disabled>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="fullname" class="form-control-label">Full name</label>
                      <input type="text" id="fullname" name="fullname" class="form-control" value="<?php echo $rows['proffesion'].': '. $rows['full_name'];?>" disabled>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="pass1" class="form-control-label">New Password</label>
                      <input type="password" id="pass1" name="pass1" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="pass2" class="form-control-label">Confirm Password</label>
                      <input type="password" id="pass2" name="pass2" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <input type="submit" id="update" name="update" class="btn btn-info" value="Update Account">
                  </div>
                  <div class="col-lg-6">
                    <input type="submit" id="delete" name="delete" class="btn btn-danger" value="Delete Account">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
    </div>
    
    <footer class="footer mt-4">
      <div class="row align-items-center justify-content-center">
        <div class="col text-center">
          &copy; 2024 <a href="" class="font-weight-bold ml-1" target="_blank">Zemicahel Abraham</a>
        </div>
      </div>
    </footer>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
