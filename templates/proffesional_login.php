<?php

require('db.php');
session_start();
if (isset($_POST['username'])){
		
		$username = stripslashes($_REQUEST['username']); 
		$username = mysqli_real_escape_string($conn,$username);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($conn,$password);

        $query = "SELECT * FROM `proffesionals`  WHERE username='$username' and password='$password'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		$rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count==1){
			$_SESSION['username'] = $username;
            $_SESSION['id']= $rows['username'];
			header("Location: proffesional_nav.php");
            } 
}

?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <style>
      body {
        font-family: 'inter', sans-serif;
        background-image: url('images/background.png'); 
        background-size: cover;
        color: #333;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
      }

          .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            width: 100%;
            flex-direction: column;
          }

          .navbar {
            background-color: #5e72e4;
          }

          .navbar-brand h1 {
            color: white;
          }

          .container {
           background-color: rgba(0, 0, 0, 0.5);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
          }

          h1 {
            font-size: 42px;
            margin-bottom: 20px;
            color:  white;
          }
          h2 {
           
           margin-bottom: 20px;
           color:  white;
         }
          .form-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
          }

          .form-group label {
            font-weight: bold;
            color:  white;
            width: 75%;
          }

          .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
            width: 75%;
          }

          .btn-customized {
            background-color: rgb(14, 43, 54);
            border-color: rgb(14, 43, 54);
            color: #ffffff;
            width: 75%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
          }

          .btn-customized:hover {
            background-color: #324cdd;
            border-color: #324cdd;
          }

          .footer {
            padding: 20px 0;
            background: linear-gradient(to bottom, rgb(114, 143, 154), rgb(14, 43, 54));
            text-align: center;
            color: #6c757d;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
          }

          .footer a {
            color:  white;
            text-decoration: none;
          }

          .footer a:hover {
            text-decoration: underline;
          }
  </style>
</head>

<body>
  <div class="main-content">
   

    <div class="container">
      <center>
        <h1>Hiv Screening Center</h1>
      </center>
      <center>
        <h2>Professional Login Page</h2>
      </center>
      <form class="form-example" action="" method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" placeholder="Username" name="username" class="form-control username" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" placeholder="Password" name="password" class="form-control password" required>
        </div>
        <center>
          <button type="submit" name="submit" class="btn btn-primary btn-customized mt-4">
            Login
          </button>
        </center>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6">
        <div class="copyright text-center text-xl-left text-muted">
          &copy; 2024 <a href="#" class="font-weight-bold ml-1">Zemicahel Abraham</a>
        </div>
      </div>
    </div>
  </footer>

  <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/argon.js?v=1.0.0"></script>
</body>

</html>
