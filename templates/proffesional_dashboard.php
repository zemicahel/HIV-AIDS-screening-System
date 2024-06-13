<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: index");
    exit();
}

require('db.php');
$id = $_SESSION['username'];

$sql = "SELECT count(*) from `patient_register` Where created_by='admin'";
$result = $conn->query($sql);

while($row = mysqli_fetch_array($result)) {
    $labe11 = $row['count(*)'];
}

$sql1 = "SELECT * FROM `proffesionals` WHERE username ='$id'";
$result1 = $conn->query($sql1);
while($row1 = mysqli_fetch_array($result1)) {
  $fullname = $row1['full_name'];
  $usernaem = $row1['username'];
  $address = $row1['address'];
  $phone = $row1['phone'];
  $gender = $row1['gender'];
  $proffesion = $row1['proffesion'];
  $age = $row1['age'];

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
        <h1>You have inserted</h1>
        <h1><?php echo $labe11; ?></h1>
        <h2>users in this system</h2>
    </div>
    <div class="card">
        <h1>Welcome </h1>
        <h3> Full Name: <?php echo  $fullname ; ?></h3>
        <h3> proffesion: <?php echo  $proffesion ; ?></h3>
        <h3> Username: <?php echo  $usernaem ; ?></h3>
        <h3> Age: <?php echo  $age ; ?></h3>
        <h3> gender: <?php echo  $gender ; ?></h3>
        <h3> Address: <?php echo  $address ; ?></h3>
        <h3> phone: <?php echo  $phone ; ?></h3>

        
        

        
    </div>
</div>

<div class="table-container">
    <table class="table table-striped table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Full Name</th>
                <th>Username</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM `patient_register` WHERE created_by='admin' LIMIT 8");
            while ($row2 = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $row2['firstname'] . ' ' . $row2['lastname'] . "</td>";
                echo "<td>" . $row2['username'] . "</td>";
                echo "<td>" . $row2['phone'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
function showLogoutPopup() {
    document.getElementById('logoutPopup').style.display = 'block';
}

function closeLogoutPopup() {
    document.getElementById('logoutPopup').style.display = 'none';
}

function confirmLogout() {
    closeLogoutPopup();
    alert('You have been logged out.');
}
</script>
 </body>
  <style>body {
             font-family: 'Inter', sans-serif; 
    margin: 0;
    padding: 0;
}

.profile-icon {
    font-size: 15px; 
    margin-left: 5px;
    color: #000000; 
}

.header {
    background-color: rgb(14, 43, 54);
    color: #ffffff;
    padding: 2rem 1rem;
    text-align: center;
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

/* Add this rule */
.card h3 {
    color: white;
}

.user-details {
    margin-top: 0px;
    text-align: center;
}

.user-details h3 {
    margin: 25px 0;
    color: rgb(14, 43, 54);
}

.table-container {
    width: 90%; 
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
