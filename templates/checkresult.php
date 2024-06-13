<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: index");
    exit(); 
}

require('db.php');
$id= $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif; 
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .input-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        #usernameDisplay {
            margin-left: 10px;
        }
        .results-table-container {
            margin-top: 20px;
            width: 100%;
            overflow-x: auto;
        }
        .results-table {
            width: 100%;
            min-width: 1000px; /* Increase the minimum width */
            border-collapse: collapse;
        }
    
        .print-stamp {
            display: none; /* Hidden by default */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 72px;
            color: rgba(255, 0, 0, 0.3); /* Red color with transparency */
            z-index: 9999; /* Make sure it stays on top */
            pointer-events: none; /* Ensure it doesn't interfere with page content */
        }
        @media print {
            .print-button {
                display: none;
            }
            .print-stamp {
                display: block;
            }
        }
    </style>
    <script>
        function submitForm() {
            const username = document.getElementById('input1').value;
            if (username) {
                fetch(`search.php?username=${username}`)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('resultsTableBody').innerHTML = data;
                        document.getElementById('usernameDisplay').innerText = username;
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                alert('Please enter a username.');
            }
        }

        function printTable() {
            const printContent = document.querySelector('.results-table-container').innerHTML;
            const originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            window.location.reload(); // To reload the page after printing
        }
    </script>
</head>
<body>

<div class="container">
    <div class="input-container">
        <div class="input-group mr-3">
            <input type="text" id="input1" class="form-control" placeholder="Enter User Id">
        </div>
        <button class="btn btn-primary" onclick="submitForm()">Search</button>
    </div>
    
    <h3>Displaying data for user id with <span id="usernameDisplay"></span></h3>

</div>
<button class="btn btn-secondary print-button" onclick="printTable()">Print</button>

    <div class="results-table-container">
        <div class="print-stamp">CONFIDENTIAL</div>
        <table class="table table-striped table-hover table-bordered results-table">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Question</th>
                    <th>Answer</th>
                </tr>
            </thead>
            <tbody id="resultsTableBody">
                <!-- Results will be displayed here -->
            </tbody>
        </table>
    </div>
</body>
</html>
