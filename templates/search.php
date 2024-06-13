<?php
require('db.php');

if(isset($_GET['username'])) {
    $username = $_GET['username'];
    $stmt = $conn->prepare("SELECT question, answer FROM user_responses WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $counter = 1;
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $counter . "</td>";
        echo "<td>" . htmlspecialchars($row['question']) . "</td>";
        echo "<td>" . htmlspecialchars($row['answer']) . "</td>";
        echo "</tr>";
        $counter++;
    }
    $stmt->close();
}
?>
