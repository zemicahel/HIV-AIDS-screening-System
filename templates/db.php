<?php
$servername="localhost";
$username="root";
$password="";
$database="hivexpert";

$conn=mysqli_connect($servername,$username,$password,$database);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>