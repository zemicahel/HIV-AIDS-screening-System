<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: index");
    exit(); 
}
require('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetching form data and sanitizing it
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $profession = mysqli_real_escape_string($conn, $_POST['profession']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);


    if ($password !== $password2) {
        die("Passwords do not match.");
    }

     $query = "INSERT INTO proffesionals (full_name, username, address, phone, age, gender, proffesion, password) 
              VALUES ('$fullname','$username','$address','$phone','$age','$gender','$profession','$password')";
    
    if (mysqli_query($conn, $query)) {
        echo"<script>alert('Success!!');</script>";
    } else {
        echo"<script>alert('Make Sure Same!!');</script>";
       
    }
    mysqli_close($conn);
}

$id= $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Professional Registration</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8"> <!-- Increased card width to col-md-8 -->
                <div class="card custom-card-width"> <!-- Added custom-card-width class -->
                    <div class="card-header text-center">
                        <h4>HIV/AIDS Screening System</h4>
                        <p>Professional Registration Form</p>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">Fullname</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Firstname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Profession</label>
                                        <input type="text" class="form-control" id="profession" name="profession" placeholder="Profession" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <input type="number" class="form-control" id="age" name="age" placeholder="Age" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="male" name="gender" value="male" required>
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="female" name="gender" value="female" required>
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password1">Enter Password</label>
                                        <input type="password" class="form-control" id="password1" name="password" placeholder="Enter Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password2">Confirm Password</label>
                                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password" required>
                                    </div>
                                    <div class="form-group d-none">
                                        <input type="text" id="creater" name="creater" value="<?php echo htmlspecialchars($id); ?>">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="submit">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#phone').keyup(function(e){
            if($(this).val().match(/^0/)){
                $(this).val('');
                return false;
            }
        });
    </script>
    <style>
        .container{
            max-width: 100%;
        }
        .card-header {
            background-image: url('images/background.png');
            background-size: cover;
            color: white; 
        }
        .custom-card-width {
            width: 100%; 
            margin: auto; 
        }
    </style>
</body>
</html>
