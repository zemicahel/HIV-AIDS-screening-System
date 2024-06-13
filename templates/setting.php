<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: index");
exit(); }
require('db.php');
$id= $_SESSION['username'];
error_reporting(0);
$query = "SELECT * FROM `patient_register`  WHERE username='$id'";
$result= mysqli_query($conn, $query);
$rows= mysqli_fetch_array($result, MYSQLI_ASSOC);
$id1=$rows['username'];
$pass1=$_POST['pass1'];
$pass2 =$_POST['pass2'];

if(isset($_POST['update'])){
if($pass1!=""&&$pass2!=""){
  if($pass1==$pass2){
        $query = " UPDATE `patient_register` SET `password` = '$pass1' WHERE username = '$id1'";
        $result= mysqli_query($conn, $query);
        echo"<script>alert('Password Changed Successfully!!');</script>";
    }
    else{
        echo"<script>alert('Make Sure You Types both Passwords The Same!!');</script>";
    }
}
else{
    echo"<script>alert('Make Sure You Fill All The Necessary Inputs!!');</script>";
}

}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <title>Hades</title>
  <style>
    body {
      font-family: 'Times New Roman', Times, serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
    }

    .header {
      height: 250px;
      background-image: url('images/background.png');
      background-size: cover;
      color: #ffffff;
      padding: 2rem;
      text-align: center;
      margin: 2rem;
      border-radius: 1rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .container-fluid {
      display: flex;
      flex-direction: row;
      justify-content: center;
      padding: 50px;
      gap: 20px;
    }

    .card {
      background-color: #ffffff;
      border: 1px solid #dfe6e9;
      border-radius: 0.5rem;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 1rem;
      max-width: 800px;
      width: 100%;
    }

    .card-profile .card-body {
      padding: 2rem;
    }

    .form-control {
      width: calc(100% - 1rem);
      padding: 0.5rem;
      margin-bottom: 1rem;
      border: 1px solid #dfe6e9;
      border-radius: 0.25rem;
    }

    .btn {
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 0.25rem;
      cursor: pointer;
    }

    .btn-info {
      background-color: #0e2b36;
      color: #ffffff;
    }

    .btn-danger {
      background-color: #d63031;
      color: #ffffff;
    }

    .btn-custom {
      background-color: rgb(14, 43, 54);
      color: #ffffff;
      width: 50%;
    }

    .h5,
    .h2,
    .h3,
    .h1 {
      margin-bottom: 0.5rem;
    }

    .font-weight-bold {
      font-weight: bold;
    }

    .font-weight-light {
      font-weight: 300;
    }

    .text-center {
      text-align: center;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    /* Added styles for the popup */
    .popup {
      display: none;
      position: fixed;
      z-index: 9;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
      padding-top: 60px;
    }

    .popup-content {
      background-color: #fefefe;
      margin: 5% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 300px;
    }

    .popup-content .btn {
      width: 100%;
    }

    .popup .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .popup .close:hover,
    .popup .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="header">
    <h1>Hello <?php echo $rows['firstname'] ?></h1>
    <p>This is your profile page. You can view your details and update your password.</p>
  </div>

  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="text-left">
          <h1><label for="name">Full Name: </label> <?php echo $rows['firstname'] . ' ' . $rows['lastname']; ?></h1>
          <h3>User ID: <?php echo $rows['username']; ?></h3>
          <div class="h5 font-weight-300">
            <h2><label for="userid">Gender: </label><?php echo $rows['gender']; ?></h2>
          </div>
          <div class="h5 font-weight-300">
            <h2><label for="address"> Address: </label><?php echo $rows['address']; ?></h2>
          </div>
          <div class="h5 mt-4">
            <h2><label for="phone">Phone Number: </label><?php echo '+251' . $rows['phone']; ?></h2>
          </div>
          <div class="h5 mt-4">
            <h2><label for="age">Age: </label><?php echo $rows['age']; ?></h2>
          </div>
          <hr class="my-4" />
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <form method="POST">
          <h6 class="heading-small text-muted mb-4">User Password Update Center</h6>
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="userid">User Id</label>
                  <input type="text" id="userid" name="userid" class="form-control" placeholder="<?php echo $rows['username']; ?>" disabled="disabled">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fullname">Full name</label>
                  <input type="text" id="fullname" name="fullname" class="form-control" placeholder="<?php echo $rows['firstname'] . ' ' . $rows['lastname']; ?>" disabled="disabled">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="pass1">New Password</label>
                  <input type="password" id="pass1" name="pass1" class="form-control" placeholder="Enter new password">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="pass2">Confirm Password</label>
                  <input type="password" id="pass2" name="pass2" class="form-control" placeholder="Confirm new password">
                </div>
              </div>
            </div>
            <div class="text-center">
              <input type="submit" name="update" class="btn btn-primary" value="Update Password" style="background-color: rgb(14, 43, 54);">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
