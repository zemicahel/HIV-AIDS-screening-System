<?php
session_start();
if(!isset($_SESSION["username"])){
    echo "Session username is not set. Redirecting...";
    header("Location: nav.php");
    exit();
}

?>
