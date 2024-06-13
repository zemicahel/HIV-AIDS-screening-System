<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: index");
exit(); }

require('db.php');
$id= $_SESSION['username'];

$sql = "SELECT count(*) from `user_responses` Where username='$id'";
$result = $conn->query($sql);

while($row = mysqli_fetch_array($result)) {
    $labe11 = $row['count(*)'];
}

$sql1 = "SELECT * FROM `patient_register` WHERE username ='$id' LIMIT 1";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    // Fetch the first row
    $row1 = $result1->fetch_assoc();
   
    $firstname = $row1['firstname'];
    $lastname = $row1['lastname'];
    $username = $row1['username'];
    $address = $row1['address'];
    $phone = $row1['phone'];
    $gender = $row1['gender'];
} else {
    echo "No results found.";
}

$query = mysqli_query($conn, "SELECT DISTINCT DATE(created_at) AS unique_date FROM `user_responses`");
$data_count = 0;
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $data_count++;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
 
    <div class="cards-container">
        <div class="card">
            <h1>You have used the system</h1>
            <h1> <?php echo $data_count; ?> </h1>
            <h2>Times</h2>

            <div class="user-details">
                <h3>Full Name: <?php echo $firstname . ' ' . $lastname; ?></h3>
                <h3>User Id: <?php echo $username; ?></h3>
                <h3>Address: <?php echo $address; ?></h3>
                <h3>Phone Number: <?php echo $phone; ?></h3>
                <h3>Phone Number: <?php echo $gender; ?></h3>
            </div>
        </div>
    </div>

    <table class='table' width='100%' id='table_transaction'> 
    <thead>
            <tr>
                <th>User Id</th>
                <th>Question</th>
                <th>Answer</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
            $query = mysqli_query($conn,"SELECT * FROM `user_responses` WHERE username='$id'LIMIT 5");    
            while($row2 = mysqli_fetch_array($query)){
                echo "<tr>";
                echo "<td>" . $row2['username'] . "</td>";
                echo "<td>" . $row2['question'] . "</td>";
                echo "<td>" . $row2['answer'] . "</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</body>
<style>
    body {
      font-family: 'Inter', sans-serif; 
        margin: 0;
        padding: 0;
    }

 
    .cards-container {
        display: flex;
        justify-content: center;
        padding-top: 85px;
    }

    .card {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 25px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 0 10px;
        padding: 20px;
        width: 450px;
        text-align: center;
    }

    .card h1 {
        margin: 0 0 10px;
        color: rgb(14, 43, 54);
    }

    .card h2 {
        margin: 0;
        color: rgb(14, 43, 54);
    }

    .user-details {
        margin-top: 20px;
        text-align: center;
    }

    .user-details h3 {
        margin: 25px 0;
        color: rgb(14, 43, 54);
    }

    .table {
    width: 95%;
    border-collapse: collapse;
    margin: 20px auto;
    border-radius: 15px; 
    overflow: hidden;
        }


    .table, .table td {
        border: 1px solid #dee2e6;
        padding: 10px;
        text-align: center;
    }

    .table th {
        border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        
    }
    .table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table tr:nth-child(odd) {
        background-color: #ffffff;
    }

    .table td {
        color: #333;
    }
</style>
</html>
