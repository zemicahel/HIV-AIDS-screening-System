<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: index");
    exit(); 
}

require('db.php');
$id = $_SESSION['username'];

$search_query = '';
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
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
</head>
<body>
<div class="container">
    <form method="post" action="" class="form-inline mb-3">
        <div class="form-group mb-2" style="flex-grow: 1;">
            <input type="text" name="search" class="form-control" placeholder="Search by Username or Question" style="width: 100%;" value="<?php echo htmlspecialchars($search_query); ?>">
        </div>
        <button type="submit" class="btn btn-primary mb-2 ml-2">Search</button>
    </form>
    
    
</div>
<div class="table-container">
        <table class="table table-striped table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>   
                    <th>User Id</th>
                    <th>Question</th>
                    <th>Result</th>
                    <th>Processed At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query_string = "SELECT question, answer, result, username, MIN(created_at) as created_at FROM user_responses WHERE username LIKE ? OR question LIKE ? GROUP BY username";
                $stmt = $conn->prepare($query_string);
                $search_term = '%' . $search_query . '%';
                $stmt->bind_param("ss", $search_term, $search_term);
                $stmt->execute();
                $result = $stmt->get_result();
                $counter = 1;
                while($row2 = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $counter . "</td>";
                    echo "<td>" . $row2['username'] . "</td>";
                    echo "<td>" . $row2['question'] . "</td>";
                    echo "<td>" . $row2['result'] . "</td>";
                    echo "<td>" . $row2['created_at'] . "</td>";
                    echo "</tr>";
                    $counter++;
                }
                ?>
            </tbody>
        </table>
    </div>
<style>
    body {
        font-family: 'Inter', sans-serif; 
        margin: 0;
        padding: 0;
    }

    .container {
        width: 95%; 
        margin: 20px auto;
    }

    .form-inline .form-group {
        display: flex;
        flex-grow: 1;
        margin-right: 10px;
    }

    .form-inline .btn {
        vertical-align: top;
    }

    .table-container {
        width: 100%;
        margin: 20px 0;
    }

    .table {
        width: 100%; 
        border-collapse: collapse;
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
</body>
</html>
