<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HADES</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif; 
        }
        .bg {
            background-image: url('images/background.png');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            color: white;
        }
        .content {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            width: 400px;
            height: 400px;
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .buttons {
            
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .buttons .btn {
            background-color:rgb(14, 43, 54);
            margin: 5px;
            width: 200px;
            transition: background-color 0.3s;
        }
    </style>
</head>
<body>

    <div class="bg">
        <div class="container content">
            <div class="card">
                <div class="buttons">
                    <a href="login.php" class="btn btn-primary">User Login</a>
                    <a href="proffesional_login.php" class="btn btn-primary">Professional Login</a>
                    <a href="admin_login.php" class="btn btn-primary">Admin Login</a>
                    <a href="contactus.php" class="btn btn-primary">Contact Us</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center text-white py-3" style="background-color: rgba(0, 0, 0, 0.7);">
        <p>&copy; 2024 HADES. All Rights Reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
