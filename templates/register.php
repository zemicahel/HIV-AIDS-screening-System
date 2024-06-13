<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index");
    exit();
}
require('db.php');
$id = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .form-container {
            max-width: 400px;
            margin: 10px auto; /* Reduced top margin */
            padding-top: 10px; /* Optional: To add some top padding */
        }

        .card {
            padding: 15px;
        }

        .form-group label {
            display: block;
            text-align: center;
        }

        .header-background {
            background: linear-gradient(to bottom, grey, rgb(14, 43, 54));
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
        }

        .header-background h2 {
            color: white;
            font-size: 18px;
        }

        .btn {
            background-color: rgb(14, 43, 54);
            width: 100%;
            margin: 0 auto;
        }

        .btn:hover {
            background-color: white;
            color: rgb(14, 43, 54);
        }

        .form-check-label {
            margin-bottom: 0;
        }

        .form-check-inline {
            display: flex;
            align-items: center;
        }

        .d-flex {
            justify-content: center;
        }

        .form-check {
            margin-right: 10px;
        }

        .btn-block {
            margin-top: 10px;
        }

        .back-button-container {
            margin-bottom: 10px; /* Added margin-bottom for spacing */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="back-button-container">
            <button type="button" onclick="goBack()" class="btn btn-secondary">Go Back</button>
        </div>
        <div class="form-container">
            <div class="card">
                <form method="post" action="{{ url_for('register') }}">

                    <div class="header-background">
                        <h2>HIV/AIDS Screening System Patient Registration Form</h2>
                    </div>

                    <div class="form-group">
                        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Firstname" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Lastname" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="age" name="age" class="form-control" placeholder="Age" required>
                    </div>
                    <div class="form-group">
                        <div class="d-flex align-items-center">
                            <label>Gender:</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="male" name="gender" value="male" class="form-check-input" required>
                                <label for="male" class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="female" name="gender" value="female" class="form-check-input" required>
                                <label for="female" class="form-check-label">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" id="address" name="address" class="form-control" placeholder="Address" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password1" name="password" class="form-control" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password2" name="password2" class="form-control" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group" style="visibility: hidden;">
                        <input type="text" id="creater" name="creater" value="<?php echo htmlspecialchars($id); ?>">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

    <script>
        function goBack() {
            window.history.back();
        }

        $('#phone').keyup(function (e) {
            if ($(this).val().match(/^0/)) {
                $(this).val('');
                return false;
            }
        });
    </script>
</body>

</html>
