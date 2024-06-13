<?php

session_start();
if(!isset($_SESSION["username"])){
header("Location: index");
exit(); }

require('db.php');
$id= $_SESSION['username'];

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


    <table class='table' width='100%' id='table_transaction'> 
    <thead>
            <tr>
                <th>#</th>   
                <th>Question</th>
                <th>Answer</th>
                <th>Result</th>
                <th>Proccessed At </th>
                
            </tr>
        </thead>
        <tbody>
        <?php
            $query = mysqli_query($conn,"SELECT * FROM `user_responses` WHERE username='$id'");    
            $counter = 1;
            while($row2 = mysqli_fetch_array($query)){
                echo "<tr>";
                echo "<td>" . $counter . "</td>";
                echo "<td>" . $row2['question'] . "</td>";
                echo "<td>" . $row2['answer'] . "</td>";
                echo "<td>" . $row2['result'] . "</td>";
                echo "<td>" . $row2['created_at'] . "</td>";
                echo "</tr>";
                $counter++;
            }
        ?>
        </tbody>
    </table>
</body>
<style>
    body {
        font-family:'Times New Roman', Times, serif;
        margin: 0;
        padding: 0;
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
