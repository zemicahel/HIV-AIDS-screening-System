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
    <title>Website Dashboard</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>

    <div class="container">
        <nav class="sidebar">
            <div class="logo">
                <img src="images/hivimage.png" alt="Logo" height="60px" width="60px"> <h1>HADES</h1>
            </div>
     <div class="lists">
                  <ul>
                <li class="active">
                    <a href="userdashboard.php">
                        <img src="images/dashboard.gif" alt="Dashboard Icon" width="30px" height="30px">
                        Dashboard
                    </a>
                </li>
                <li>    
                    <a href="patientdata.php"><img src="images/data.gif" width="30px" height="30px" alt="Your check Icon">
                    Your Data</a>
                </li>
                <li>    
                    <a href="checkresult.php"><img src="images/data.gif" width="30px" height="30px" alt="Your check Icon">
                    Check Answers</a>
                </li>

            </ul>

            <a class="external-link" href="http://127.0.0.1:5000" ><img src="images/expert.gif" width="30px" height="30px" alt="Your expert Icon">Expert system</a>
            <ul class="lower-ul">
              
            <li>
                <a href="setting.php"><img src="images/setting.gif" width="30px" height="30px" alt="Your Setting Icon">Settings</a>
            </li>
            <li>
                <a href="aboutus.php"><img src="images/aboutus.png" width="30px" height="30px" alt="Your aboutus Icon">About us</a>
            </li>
            
        </ul>
     </div>
       
      <div class="logout"><a href="#" onclick="showLogoutPopup()">Logout</a></div>
        
           
        

        </nav>
        <div class="content">
            <iframe id="content-frame" src="userdashboard.html" name="content-frame" frameborder="0" class="content-frame"></iframe>
        </div>
    </div>
            <div id="logoutPopup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="closeLogoutPopup()">&times;</span>
                <p>Are you sure you want to log out?</p>
                <div class="button-container">
                    <button class="btn btn-danger" onclick="confirmLogout()">Yes</button>
                    <button class="btn btn-info" onclick="closeLogoutPopup()">No</button>
                        </div>
                    </div>
                </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const links = document.querySelectorAll(".sidebar ul li a");
            const iframe = document.getElementById("content-frame");

            links.forEach(link => {
                link.addEventListener("click", function(event) {
                    event.preventDefault();
                    links.forEach(link => link.parentElement.classList.remove("active"));
                    this.parentElement.classList.add("active");
                    iframe.src = this.getAttribute("href");
                });
            });

            // Trigger click on the first link
            links[0].click();
        });

        function showLogoutPopup() {
        document.getElementById('logoutPopup').style.display = 'block';
    }

    function closeLogoutPopup() {
        document.getElementById('logoutPopup').style.display = 'none';
    }

    function confirmLogout() {
        window.location.href = 'logout.php';
    }
</script>
    
</body>
<style>
    body {
        font-family: 'Inter', sans-serif; 
    margin: 0;
    padding: 0;
    display: flex;
    height: 100vh;
        }

        .container {
            display: flex;
            width: 100%;
        }
        .popup {
            display: none;
            position: fixed;
            z-index: 9;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }
        .popup-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 300px;
            border-radius: 10px; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
        }

        .button-container {
            display: flex; 
        }

        .popup-content .btn {
            width: 80%;
            margin: 5px; 
        }

        .popup-content .btn hover {
            width: 80%;
            margin: 5px; 
         }
        .popup .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .popup .close:hover,
        .popup .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .sidebar {
            width: 250px;
            background-image: url('images/background.png'); 
            background-size: cover;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
        }

        .sidebar .lists {
            padding-top: 150px;
        }

        .sidebar ul {
                list-style-type: none;
                padding: 0;
                width: 100%; 
                margin: 0;
            }
        .sidebar ul li {
            width: 100%; 
            text-align: left;
            margin-bottom: 10px;
            margin-left: 16px;
        }

                    .sidebar ul li a {
                display: flex;
                align-items: center;
                gap: 10px; 
                padding: 10px;
                color: white;
                text-decoration: none;
                font-weight: bold;
                font-size: 18px;
                transition: background-color 0.3s;
            }

            .sidebar ul li a img {
            vertical-align: middle;
            }       

        .sidebar ul li a:hover {
            background-color: #21617A;
            border-top-left-radius: 15px; 
            border-bottom-left-radius: 15px; 
        }

        .sidebar ul li.active a {
            background-color: #21617A;
            display: block;
            width: 100%; 
            border-top-left-radius: 15px; 
            border-bottom-left-radius: 15px; 
        }

        .sidebar a.external-link {
            display: flex;
            align-items: center;
            gap: 10px; 
            padding: 10px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            transition: background-color 0.3s;
            width: calc(100% - 32px);
            margin-left: 16px;
            margin-top: 0; 
                }

        .lower-ul {
            margin-top: 0; 
        }
            .logout{
                padding-top: 150px;
            }

            .logout a{
                
                display: flex;
            align-items: center;
            gap: 10px; 
            padding: 10px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            transition: background-color 0.3s;
            width: calc(100% - 32px);
            margin-left: 16px;
            margin-top: 0; 
            }
            .logout a:hover{
                background-color: #21617A;
                border-radius: 15px;
                       }
            
                    .sidebar a.external-link:hover {
            background-color: #21617A;
            border-top-left-radius: 15px; 
            border-bottom-left-radius: 15px; 
        }
        .content {
            flex-grow: 1;
            padding: 0;
            background-color: #ecf0f1;
            display: flex;
            flex-direction: column;
        }

        .content-frame {
            flex-grow: 1;
            width: 100%;
            border: none;
        }
        .logo {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px; 
        }

        .logo img {
            margin-right: 10px; 
            height: 60px;
            width: 60px;
        }

        .logo h2 {
            margin: 0;
        }
</style>
</html>
