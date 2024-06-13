<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">   
    <link rel="shortcut icon" type="x-icon" href="images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
    <style>
        body {
            background-image: url('images/background.png');
            height: 100vh; /* Adjusted height to ensure full screen coverage */
            margin: 0;
            font-family: 'Inter', sans-serif; 
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Adjust styles if needed */
    </style>
</head>

<body>

     

    <div class="container"><a href="Home.php" class="btn btn-info mb-3">Back</a>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-5">Contact Us</h1>
               
                <form action="https://formspree.io/f/mleqyqnz" method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="_replyto"
                            placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="5"
                            placeholder="Enter your message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
