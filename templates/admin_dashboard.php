<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: index");
    exit();
}

require('db.php');
$id = $_SESSION['username'];

$sql = "SELECT count(*) from `patient_register`";
$result = $conn->query($sql);

while($row = mysqli_fetch_array($result)) {
    $usercount = $row['count(*)'];
}

$sql1 = "SELECT count(*) from `proffesionals`";
$result1 = $conn->query($sql1);

while($row1 = mysqli_fetch_array($result1)) {
    $professionalcount = $row1['count(*)'];
}

$sql1 = "SELECT * FROM `admin` WHERE username ='$id'";
$result1 = $conn->query($sql1);
while($row1 = mysqli_fetch_array($result1)) {

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>




<div class="cards-container">
    <div class="card">
        <h1>There are </h1>
        <h1><?php echo $usercount; ?></h1>
        <h2>users in this system</h2>
    </div>
    <div class="card">
    <h1>There are </h1>
        <h1><?php echo $professionalcount; ?></h1>
        <h2>proffesionals in this system</h2>
    
    </div>
</div>

<div class="table-container">
    <table class="table table-striped table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Proffession</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM `proffesionals`  LIMIT 10");
            while ($row2 = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $row2['proffesion'] . "</td>";
                echo "<td>" . $row2['full_name']. "</td>";
                echo "<td>" . $row2['username'] . "</td>";
                echo "<td>" . $row2['phone'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
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
            background-image: url('images/background.png');
            background-size: cover;
            border: 1px solid #dee2e6;
            border-radius: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 0 10px;
            padding: 20px;
            width: 450px;
            max-height: 500px;
            text-align: center;
        }

        .card h1 {
            margin: 0 0 10px;
            color: white;
        }

        .card h2 {
            margin: 0;
            color: white;
        }

        .user-details {
            margin-top: 0px;
            text-align: center;
        }

        .user-details h3 {
            margin: 25px 0;
           color: red;
        }

        .table-container {
            width: 95%;
            margin: 20px auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 15px;
            overflow: hidden;
            margin-top: 30px;
        }

        .table, .table td {
          
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }

        .table thead {
            background-color: #343a40;
            color: #ffffff;
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
